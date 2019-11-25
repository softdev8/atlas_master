<template>
    <div id="saved-projects">
        <div class="header collapsed" href="#saved-projects-wrap" data-toggle="collapse">
            Saved projects
        </div>
        <div class="saved-projects-wrap collapse" id="saved-projects-wrap">
            <div class="content">
                <div v-if="obtainSavedProjectsLoading" class="loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="s-s-table" v-if="totalPages > 0">
                    <div class="s-s-head">
                        <div class="s-s-row">
                            <div class="title">Name</div>
                            <div class="last-open">Date last open</div>
                            <div class="candidates">Candidates</div>
                        </div>
                    </div>
                    <div class="s-s-body">
                        <div
                                class="s-s-row"
                                :class="{ isActive: isActiveProject(project) }"
                                v-for="project in paginatedProjects"
                                @click="chooseProject(project)">
                            <div class="title">
                                {{project.title}}
                            </div>
                            <div class="last-open">
                                {{project.lastOpen}}
                            </div>
                            <div class="candidates">
                                {{project.candidates.length}}
                            </div>
                            <div class="delete">
                                <button
                                        type="button"
                                        class="btn btn-danger"
                                        @click.stop="showDeleteModal(project.id)">
                                    Delete
                                </button>
                            </div>
                            <div class="export">
                                <button
                                        v-if="!(projectIdToExport === project.id && exportCandidatesLoading)"
                                        type="button"
                                        class="btn btn-primary"
                                        @click.stop="exportCandidates(project.id, project.userId)">
                                    Export
                                </button>
                                <div
                                        v-if="projectIdToExport === project.id && exportCandidatesLoading"
                                        class="spinner-border text-primary"
                                        role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="s-s-pagination" v-if="totalPages > 0">
                    <div class="pages">
                        Page <span>{{currentPage}}</span> of <span>{{totalPages}}</span>
                    </div>
                    <div class="controls">
                        <button
                                type="button"
                                v-if="showPrevious"
                                @click="previousPage()"
                                class="btn btn-primary previous">
                            Previous
                        </button>
                        <button
                                type="button"
                                v-if="showNext"
                                @click="nextPage()"
                                class="btn btn-primary next">
                            Next
                        </button>
                    </div>
                </div>

                <div class="no-data" v-if="noData">
                    No data to display
                </div>
            </div>
        </div>
        <popup-component
                :show="showCreatePopup"
                :title="'Save project'"
                @onClose="closeCreateModal">
            <div v-if="createLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!createLoading" @submit.prevent="createProject">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <span>Name of the project:</span>
                    </div>
                    <div class="form-group col-sm-6">
                        <input
                                v-model="title"
                                type="text"
                                class="form-control"
                                placeholder="">
                    </div>
                    <div class="form-group col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </popup-component>
        <popup-component
                :show="showSaveAsPopup"
                :title="'Save project as...'"
                @onClose="closeSaveAsModal">
            <div v-if="saveAsLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!saveAsLoading" @submit.prevent="saveAsProject">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <span>Name of the project:</span>
                    </div>
                    <div class="form-group col-sm-6">
                        <input
                                v-model="title"
                                type="text"
                                class="form-control"
                                placeholder="">
                    </div>
                    <div class="form-group col-sm-2">
                        <button type="submit" class="btn btn-primary btn-block">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </popup-component>
        <popup-component
                :show="showUpdatePopup"
                :title="'Apply changes ?'"
                @onClose="closeUpdateModal">
            <div v-if="updateLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!updateLoading" @submit.prevent="updateProject">
                <div class="form-row">
                    <div class="form-group col-sm-2 offset-sm-3">
                        <button type="submit" class="btn btn-danger btn-block">
                            Yes
                        </button>
                    </div>
                    <div class="form-group col-sm-2 offset-sm-2">
                        <button type="button" class="btn btn-primary btn-block" @click="closeUpdateModal">
                            No
                        </button>
                    </div>
                </div>
            </form>
        </popup-component>
        <popup-component
                :show="showDeletePopup"
                :title="this.message"
                @onClose="closeDeleteModal">
            <div v-if="deleteLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!deleteLoading" @submit.prevent="deleteProject">
                <div class="form-row">
                    <div class="form-group col-sm-2 offset-sm-3">
                        <button type="submit" class="btn btn-danger btn-block">
                            Yes
                        </button>
                    </div>
                    <div class="form-group col-sm-2 offset-sm-2">
                        <button type="button" class="btn btn-primary btn-block" @click="closeDeleteModal">
                            No
                        </button>
                    </div>
                </div>
            </form>
        </popup-component>
    </div>
</template>

<script>
  import moment from "moment";
  import {has} from "lodash";
  import {convertArrayToCSV} from "convert-array-to-csv";

  import PopupComponent from "./PopupComponent";
  import * as projectService from "../services/project.service";
  import {skip, limit} from "../utils/pagination";

  export default {
    components: {
      PopupComponent
    },
    props: {
      searchRequest: {
        type: Object,
        required: true
      },
    },
    computed: {
      totalPages: function () {
        return Math.ceil(this.savedProjects.length / this.pageSize);
      },
      showPrevious: function () {
        return this.currentPage > 1;
      },
      showNext: function () {
        return this.currentPage < this.totalPages;
      },
      getNameOfTheProject: function () {
        return `Saved project ${this.savedProjects.length + 1}`;
      },
      paginatedProjects: function () {
        return limit(skip(this.savedProjects, (this.currentPage - 1) * this.pageSize), this.pageSize);
      },
      noData: function () {
        return this.savedProjects.length === 0 && this.obtainSavedProjectsLoading === false;
      },
      message: function () {
        if (this.projectIdToDelete !== null) {
          const index = this.savedProjects
            .findIndex(project => project.id === this.projectIdToDelete);
          if (index !== -1) {
            return `Are you sure you want to delete "${this.savedProjects[index].title}"?`;
          } else {
            return "";
          }
        } else {
          return "";
        }
      },
    },
    data() {
      return {
        savedProjects: [],
        selectedProject: null,
        selectedCandidates: [],

        obtainSavedProjectsLoading: true,

        createLoading: false,
        updateLoading: false,
        saveAsLoading: false,
        deleteLoading: false,
        exportCandidatesLoading: false,

        showCreatePopup: false,
        showUpdatePopup: false,
        showSaveAsPopup: false,
        showDeletePopup: false,

        currentPage: 1,
        pageSize: 5,

        title: "",
        projectIdToDelete: null,
        projectIdToExport: null,
      }
    },
    mounted() {
      this.obtainProjects();
    },
    methods: {
      isActiveProject: function (project) {
        return this.selectedProject !== null && this.selectedProject.id === project.id;
      },
      getLastOpen: function () {
        return moment.utc().format("YYYY-MM-DD HH:mm:ss");
      },
      convertProject: function (project, candidates = []) {
        const {
          filters,
          firms,
          regions
        } = JSON.parse(project.criterias);

        const stillUtc = moment.utc(project.last_open).toDate();
        const lastOpen = moment(stillUtc).local().format('YYYY-MM-DD HH:mm:ss');

        return {
          id: project.id,
          lastOpen,
          title: project.title,
          userId: project.user_id,
          filters,
          firms,
          regions,
          candidates: has(project, "candidates") ?
            project.candidates.map(candidate => candidate.cadidate_id) : candidates,
        };
      },

      previousPage: function () {
        this.currentPage -= 1;
      },
      nextPage: function () {
        this.currentPage += 1;
      },

      closeCreateModal: function () {
        if (this.createLoading === false) {
          this.showCreatePopup = false;
        }
      },
      showCreateModal: function () {
        this.showCreatePopup = true;
        this.title = this.getNameOfTheProject;
      },

      closeUpdateModal: function () {
        if (this.updateLoading === false) {
          this.showUpdatePopup = false;
        }
      },
      showUpdateModal: function () {
        this.showUpdatePopup = true;
        this.title = this.getNameOfTheProject;
      },

      closeDeleteModal: function () {
        if (this.deleteLoading === false) {
          this.showDeletePopup = false;

          // clear
          this.projectIdToDelete = null;
        }
      },
      showDeleteModal: function (projectId) {
        this.projectIdToDelete = projectId;
        this.showDeletePopup = true;
      },

      closeSaveAsModal: function () {
        if (this.saveAsLoading === false) {
          this.showSaveAsPopup = false;
        }
      },
      showSaveAsModal: function (selectedCandidates) {
        this.selectedCandidates = selectedCandidates;
        this.showSaveAsPopup = true;
        this.title = this.getNameOfTheProject;
      },

      chooseProject: function (project) {
        this.selectedProject = project;

        this.$emit("onChooseProject", {
          filters: project.filters,
          firms: project.firms,
          regions: project.regions,
          candidates: project.candidates,
        });

        this.refreshProject();
      },

      saveProject: function (selectedCandidates) {
        this.selectedCandidates = selectedCandidates;
        if (this.selectedProject === null) {
          this.showCreateModal();
        } else {
          this.showUpdateModal();
        }
      },

      // API
      obtainProjects: async function () {
        const params = {
          user_id: this.searchRequest.user
        };

        try {
          this.obtainSavedProjectsLoading = true;

          const data = await projectService.obtainProjects(params);
          this.savedProjects = data.project_collection
            .map(project => this.convertProject(project));

          this.obtainSavedProjectsLoading = false;
        } catch (err) {
          this.obtainSavedProjectsLoading = false;
        }
      },
      createProject: async function () {
        const request = {
          title: this.title,
          last_open: this.getLastOpen(),
          user: this.searchRequest.user,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
          candidates: this.selectedCandidates,
        };

        try {
          this.createLoading = true;

          const data = await projectService.createProject(request);
          this.savedProjects.push(this.convertProject(data.project, request.candidates));

          this.createLoading = false;
          this.closeCreateModal();
        } catch (err) {
          this.createLoading = false;
        }
      },
      updateProject: async function () {
        const request = {
          id: this.selectedProject.id,
          title: this.selectedProject.title,
          last_open: this.getLastOpen(), // TODO
          user: this.searchRequest.user,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
          candidates: this.selectedCandidates,
        };

        try {
          this.updateLoading = true;

          // data is empty array
          const data = await projectService.updateProject(request);

          // object replacement
          const index = this.savedProjects.findIndex(project => {
            return project.id === this.selectedProject.id;
          });

          if (index !== -1) {
            this.savedProjects = this.savedProjects.map(project => {
              if (this.selectedProject.id === project.id) {
                return {
                  id: request.id,
                  lastOpen: request.last_open,
                  title: request.title,
                  userId: request.user,
                  filters: request.filters,
                  firms: request.firms,
                  regions: request.regions,
                  candidates: request.candidates,
                }
              } else {
                return project;
              }
            });
          }

          this.updateLoading = false;
          this.closeUpdateModal();
        } catch (err) {
          this.updateLoading = false;
        }
      },
      saveAsProject: async function () {
        const request = {
          title: this.title,
          last_open: this.getLastOpen(),
          user: this.searchRequest.user,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
          candidates: this.selectedCandidates,
        };

        try {
          this.saveAsLoading = true;

          const data = await projectService.createProject(request);
          this.savedProjects.push(this.convertProject(data.project, request.candidates));

          this.saveAsLoading = false;
          this.closeSaveAsModal();
        } catch (err) {
          this.saveAsLoading = false;
        }
      },
      refreshProject: async function () {
        const params = {
          user_id: this.searchRequest.user,
          project_id: this.selectedProject.id,
        };

        try {
          const data = await projectService.refreshProject(params);
          const projectId = +data.project_id;
          const stillUtc = moment.utc(data.last_open).toDate();
          const lastOpen = moment(stillUtc).local().format('YYYY-MM-DD HH:mm:ss');

          this.savedProjects = this.savedProjects
            .map(project => project.id === projectId ? {...project, lastOpen} : project);
        } catch (err) {
        }
      },
      deleteProject: async function () {

        const request = {
          id: this.projectIdToDelete
        };

        try {
          this.deleteLoading = true;

          // data is empty array
          const data = await projectService.deleteProject(request);
          this.savedProjects = this.savedProjects
            .filter(project => project.id !== this.projectIdToDelete);

          this.deleteLoading = false;
          this.closeDeleteModal();
        } catch (err) {
          this.deleteLoading = false;

          // clear
          this.projectIdToDelete = null;
        }
      },
      exportCandidates: async function (projectId, userId) {

        // we can handle only one stream
        if (this.exportCandidatesLoading === false) {
          this.projectIdToExport = projectId;

          const params = {
            user_id: userId,
            project_id: this.projectIdToExport
          };

          try {
            this.exportCandidatesLoading = true;

            const data = await projectService.exportToCSV(params);
            this.exportCandidatesToCSV(data);

            this.exportCandidatesLoading = false;

            // clear
            this.projectIdToExport = null;
          } catch (err) {
            this.exportCandidatesLoading = false;

            // clear
            this.projectIdToExport = null;
          }
        }
      },
      exportCandidatesToCSV: function (data) {
        const header = [
          "Project name",
          "Firm",
          "Forename",
          "Surname",
          'Region',
          'Cities',
          'Admitted date',
          "PQE",
          "Phone number",
          "Mobile number",
          "Email address",
          "Firm profile",
          "LinkedIn",
          "Practice areas",
          "Specialisms",
          "Sub-specialisms",
          "Title",
        ];

        let dataArrays = [];

        data.candidates.forEach(candidate => {
          let practiceAreas = "";
          candidate.areas_details.forEach(item => {
            practiceAreas += item.title;
            practiceAreas += ", ";
          });
          practiceAreas = practiceAreas.slice(0, practiceAreas.length - 2);

          let specialisms = "";
          candidate.specialisms_details.forEach(item => {
            specialisms += item.title;
            specialisms += ", ";
          });
          specialisms = specialisms.slice(0, specialisms.length - 2);

          let subSpecialisms = "";
          candidate.sub_specialisms_details.forEach(item => {
            subSpecialisms += item.title;
            subSpecialisms += ", ";
          });
          subSpecialisms = subSpecialisms.slice(0, subSpecialisms.length - 2);

          const regions = candidate.regions.map(region => region.region.title).join(',');
          const cities = candidate.regions.map(region => region.city.title).join(',');

          let row = [
            data.project, // Project name
            candidate.firm.title, // Firm
            candidate.forename, // Forename
            candidate.surname, // Surname
            regions, // Regions
            cities, // Cities
            candidate.admitted_date, // Admitted Date
            candidate.pqe, // PQE
            candidate.workphone, // Phone number
            candidate.mobile_phone, // Mobile number
            candidate.email, // Email address
            candidate.website, // Firm profile
            candidate.linked_in, // LinkedIn
            practiceAreas, // Practice areas
            specialisms, // Specialisms
            subSpecialisms, // Sub-specialisms
            candidate.job_title, // Title
          ];

          dataArrays.push(row);
        });

        const csvFromArrayOfArrays = convertArrayToCSV(dataArrays, {
          header,
          separator: ','
        });

        var csvContent = new Blob([csvFromArrayOfArrays], {type: 'text/csv;charset=utf-8;'});
        var encodedURI = URL.createObjectURL(csvContent);

        const link = document.createElement("a");

        link.setAttribute("href", encodedURI);
        link.setAttribute("download", `${data.project}.csv`);

        document.body.appendChild(link); // Required for FF

        link.click();
      }
    }
  }
</script>
