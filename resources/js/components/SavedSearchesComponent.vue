<template>
    <div id="saved-searches">
        <div class="header collapsed" href="#saved-searches-wrap" data-toggle="collapse">
            Saved searches
        </div>
        <div class="saved-searches-wrap collapse" id="saved-searches-wrap">
            <div class="content">
                <div v-if="obtainSavedSearchesLoading" class="loading-spinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="s-s-table" v-if="totalPages > 0">
                    <div class="s-s-head">
                        <div class="s-s-row">
                            <div class="name">Name</div>
                            <div class="criteria">Criteria</div>
                            <div class="date">Date last run</div>
                            <div class="results">Results</div>
                        </div>
                    </div>
                    <div class="s-s-body">
                        <div
                                v-for="search in paginatedSearches"
                                :class="{ isActive: isActiveSearch(search) }"
                                @click="chooseSearch(search)"
                                :title="search.description"
                                class="s-s-row">
                            <div class="name">
                                {{search.title}}
                            </div>
                            <div class="criteria">
                                {{search.description}}
                            </div>
                            <div class="date">
                                {{search.lastRun}}
                            </div>
                            <div class="results">
                                {{search.results}}
                            </div>
                            <div class="delete">
                                <button
                                        type="button"
                                        class="btn btn-danger"
                                        @click.stop="showDeleteModal(search.id)">
                                    Delete
                                </button>
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
                :show="showPopup"
                :title="'Save search'"
                @onClose="closeModal">
            <div v-if="createSearchLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!createSearchLoading" @submit.prevent="createSearch">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <span>Name of the search:</span>
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
                :title="'Save search as...'"
                @onClose="closeSaveAsModal">
            <div v-if="saveAsLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form v-if="!saveAsLoading" @submit.prevent="saveSearchAs">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <span>Name of the search:</span>
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
            <form v-if="!updateLoading" @submit.prevent="updateSearch">
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
            <form v-if="!deleteLoading" @submit.prevent="deleteSearch">
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

  import PopupComponent from "./PopupComponent";
  import * as searchService from "../services/search.service";
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
      filters: {
        type: Object,
        required: true
      },
      firms: {
        type: Array,
        required: true
      },
      countries: {
        type: Array,
        required: true
      },
      results: {
        type: Number,
        required: true
      }
    },
    computed: {
      totalPages: function () {
        return Math.ceil(this.savedSearches.length / this.pageSize);
      },
      showPrevious: function () {
        return this.currentPage > 1;
      },
      showNext: function () {
        return this.currentPage < this.totalPages;
      },
      getNameOfTheSearch: function () {
        return `Saved search ${this.savedSearches.length + 1}`;
      },
      paginatedSearches: function () {
        return limit(skip(this.savedSearches, (this.currentPage - 1) * this.pageSize), this.pageSize);
      },
      noData: function () {
        return this.savedSearches.length === 0 && this.obtainSavedSearchesLoading === false;
      },
      message: function () {
        if (this.searchIdToDelete !== null) {
          const index = this.savedSearches
            .findIndex(search => search.id === this.searchIdToDelete);
          if (index !== -1) {
            return `Are you sure you want to delete "${this.savedSearches[index].title}"?`;
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
        savedSearches: [],
        selectedSearch: null,

        createSearchLoading: false,
        saveAsLoading: false,
        updateLoading: false,
        deleteLoading: false,
        obtainSavedSearchesLoading: true,

        currentPage: 1,
        pageSize: 5,

        showPopup: false,
        showSaveAsPopup: false,
        showUpdatePopup: false,
        showDeletePopup: false,

        title: "",
        lastRun: "",
        searchIdToDelete: null,
      }
    },
    mounted() {
      this.obtainSavedSearches();
    },
    methods: {
      previousPage: function () {
        this.currentPage -= 1;
      },
      nextPage: function () {
        this.currentPage += 1;
      },

      closeModal: function () {
        if (this.createSearchLoading === false) {
          this.showPopup = false;
        }
      },
      showModal: function () {
        this.showPopup = true;
        this.title = this.getNameOfTheSearch;
      },

      closeSaveAsModal: function () {
        if (this.saveAsLoading === false) {
          this.showSaveAsPopup = false;
        }
      },
      showSaveAsModal: function () {
        this.showSaveAsPopup = true;
        this.title = this.getNameOfTheSearch;
      },

      closeUpdateModal: function () {
        if (this.updateLoading === false) {
          this.showUpdatePopup = false;
        }
      },
      showUpdateModal: function () {
        this.showUpdatePopup = true;
      },

      closeDeleteModal: function () {
        if (this.deleteLoading === false) {
          this.showDeletePopup = false;

          // clear
          this.searchIdToDelete = null;
        }
      },
      showDeleteModal: function (searchId) {
        this.searchIdToDelete = searchId;
        this.showDeletePopup = true;
      },

      setLastRun: function () {
        this.lastRun = moment.utc().format("YYYY-MM-DD HH:mm:ss");
      },

      chooseSearch: function (search) {
        this.selectedSearch = search;

        this.$emit("onChooseSearch", {
          filters: search.filters,
          firms: search.firms,
          regions: search.regions,
        });
      },

      isActiveSearch: function (search) {
        return this.selectedSearch !== null && this.selectedSearch.id === search.id;
      },

      obtainSavedSearches: async function () {
        const params = {
          user_id: this.searchRequest.user
        };

        try {
          this.obtainSavedSearchesLoading = true;

          const data = await searchService.obtainSavedSearches(params);
          this.savedSearches = data.search_collection.map(search => this.convertSearch(search));

          this.obtainSavedSearchesLoading = false;
        } catch (err) {
          this.obtainSavedSearchesLoading = false;
        }
      },
      saveAs: function () {
        this.showSaveAsModal();
      },
      saveSearch: function () {
        if (this.selectedSearch === null) {
          this.showModal();
        } else {
          this.showUpdateModal();
        }
      },
      createSearch: async function () {
        const request = {
          title: this.title,
          results: this.results,
          last_run: this.lastRun,
          user: this.searchRequest.user,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
        };

        try {
          this.createSearchLoading = true;

          const data = await searchService.createSearch(request);
          this.savedSearches.push(this.convertSearch(data.search));

          this.createSearchLoading = false;
          this.closeModal();
        } catch (err) {
          this.createSearchLoading = false;
        }
      },
      saveSearchAs: async function () {
        const request = {
          title: this.title,
          results: this.results,
          last_run: this.lastRun,
          user: this.searchRequest.user,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
        };

        try {
          this.saveAsLoading = true;

          const data = await searchService.createSearch(request);
          this.savedSearches.push(this.convertSearch(data.search));

          this.saveAsLoading = false;
          this.closeSaveAsModal();
        } catch (err) {
          this.saveAsLoading = false;
        }
      },
      updateSearch: async function () {
        const request = {
          id: this.selectedSearch.id,
          title: this.selectedSearch.title,
          results: this.results,
          last_run: this.lastRun,
          user: this.selectedSearch.userId,
          filters: this.searchRequest.filters,
          firms: this.searchRequest.firms,
          regions: this.searchRequest.regions,
        };

        try {
          this.updateLoading = true;

          // data is empty array
          const data = await searchService.updateSearch(request);

          // object replacement
          const index = this.savedSearches.findIndex(search => {
            return search.id === this.selectedSearch.id;
          });

          if (index !== -1) {
            const {
              filters,
              firms,
              regions
            } = this.searchRequest;

            let description = "";

            // convert levels
            if (filters.levels.length > 0) {
              let levels = [];

              filters.levels.forEach(id => {
                const index = this.filters.levels.findIndex(level => level.id === id);

                if (index !== -1) {
                  levels.push(this.filters.levels[index].title);
                }
              });

              if (levels.length > 0) {
                description += levels.join(", ");
                description += " / ";
              }
            }

            // convert area
            if (filters.area) {
              const index = this.filters.areas.findIndex(area => area.id === filters.area);

              if (index !== -1) {
                description += this.filters.areas[index].title;
                description += " / ";
              }
            }

            // convert specialisms
            if (filters.specialisms.length > 0) {
              let specialisms = [];

              filters.specialisms.forEach(id => {
                const index = this.filters.specialisms.findIndex(specialism => specialism.id === id);

                if (index !== -1) {
                  specialisms.push(this.filters.specialisms[index].title);
                }
              });

              if (specialisms.length > 0) {
                description += specialisms.join(", ");
                description += " / ";
              }
            }

            // convert subspecialisms
            if (filters.subspecialisms.length > 0) {
              let subspecialisms = [];

              filters.subspecialisms.forEach(id => {
                const index = this.filters.subspecialisms.findIndex(subspecialism => subspecialism.id === id);

                if (index !== -1) {
                  subspecialisms.push(this.filters.subspecialisms[index].title);
                }
              });

              if (subspecialisms.length > 0) {
                description += subspecialisms.join(", ");
                description += " / ";
              }
            }

            // convert types
            if (filters.types.length > 0) {
              let types = [];

              filters.types.forEach(id => {
                const index = this.filters.types.findIndex(type => type.id === id);

                if (index !== -1) {
                  types.push(this.filters.types[index].title);
                }
              });

              if (types.length > 0) {
                description += types.join(", ");
                description += " / ";
              }
            }

            // convert firms
            if (firms.length > 0) {
              let _firms = [];

              firms.forEach(id => {
                const index = this.firms.findIndex(firm => firm.id === id);

                if (index !== -1) {
                  _firms.push(this.firms[index].title);
                }
              });

              if (_firms.length > 0) {
                description += _firms.join(", ");
                description += " / ";
              }
            }

            // convert regions
            if (regions.length > 0) {
              let _regions = [];

              regions.forEach(id => {
                for (let i = 0; i < this.countries.length; i++) {
                  for (let j = 0; j < this.countries[i].regions.length; j++) {
                    if (this.countries[i].regions[j].id === id) {
                      _regions.push(this.countries[i].regions[j].title);
                      return;
                    }
                  }
                }
              });

              if (_regions.length > 0) {
                description += _regions.join(", ");
                description += " / ";
              }
            }

            if (description.length > 0) {
              description = description.slice(0, description.length - 3);
            }

            let stillUtc = moment.utc(this.lastRun).toDate();
            let lastRun = moment(stillUtc).local().format('YYYY-MM-DD HH:mm:ss');

            this.savedSearches = this.savedSearches.map(search => {
              if (this.selectedSearch.id === search.id) {
                return {
                  id: this.selectedSearch.id,
                  userId: this.selectedSearch.userId,
                  title: this.selectedSearch.title,

                  filters,
                  firms,
                  regions,
                  description,
                  lastRun,
                  results: this.results,
                }
              } else {
                return search;
              }
            });
          }

          this.updateLoading = false;
          this.closeUpdateModal();
        } catch (err) {
          this.updateLoading = false;
        }
      },
      deleteSearch: async function () {
        const request = {
          id: this.searchIdToDelete
        };

        try {
          this.deleteLoading = true;

          // data is empty array
          const data = await searchService.deleteSearch(request);

          // remove object from array
          this.savedSearches = this.savedSearches
            .filter(search => search.id !== this.searchIdToDelete);

          this.deleteLoading = false;
          this.closeDeleteModal();
        } catch (err) {
          this.deleteLoading = false;

          // clear
          this.searchIdToDelete = null;
        }
      },
      convertSearch: function (search) {
        const {
          filters,
          firms,
          regions
        } = JSON.parse(search.criterias);

        let description = "";

        // convert levels
        if (filters.levels.length > 0) {
          let levels = [];

          filters.levels.forEach(id => {
            const index = this.filters.levels.findIndex(level => level.id === id);

            if (index !== -1) {
              levels.push(this.filters.levels[index].title);
            }
          });

          if (levels.length > 0) {
            description += levels.join(", ");
            description += " / ";
          }
        }

        // convert area
        if (filters.area) {
          const index = this.filters.areas.findIndex(area => area.id === filters.area);

          if (index !== -1) {
            description += this.filters.areas[index].title;
            description += " / ";
          }
        }

        // convert specialisms
        if (filters.specialisms.length > 0) {
          let specialisms = [];

          filters.specialisms.forEach(id => {
            const index = this.filters.specialisms.findIndex(specialism => specialism.id === id);

            if (index !== -1) {
              specialisms.push(this.filters.specialisms[index].title);
            }
          });

          if (specialisms.length > 0) {
            description += specialisms.join(", ");
            description += " / ";
          }
        }

        // convert subspecialisms
        if (filters.subspecialisms.length > 0) {
          let subspecialisms = [];

          filters.subspecialisms.forEach(id => {
            const index = this.filters.subspecialisms.findIndex(subspecialism => subspecialism.id === id);

            if (index !== -1) {
              subspecialisms.push(this.filters.subspecialisms[index].title);
            }
          });

          if (subspecialisms.length > 0) {
            description += subspecialisms.join(", ");
            description += " / ";
          }
        }

        // convert types
        if (filters.types.length > 0) {
          let types = [];

          filters.types.forEach(id => {
            const index = this.filters.types.findIndex(type => type.id === id);

            if (index !== -1) {
              types.push(this.filters.types[index].title);
            }
          });

          if (types.length > 0) {
            description += types.join(", ");
            description += " / ";
          }
        }

        // convert firms
        if (firms.length > 0) {
          let _firms = [];

          firms.forEach(id => {
            const index = this.firms.findIndex(firm => firm.id === id);

            if (index !== -1) {
              _firms.push(this.firms[index].title);
            }
          });

          if (_firms.length > 0) {
            description += _firms.join(", ");
            description += " / ";
          }
        }

        // convert regions
        if (regions.length > 0) {
          let _regions = [];

          regions.forEach(id => {
            for (let i = 0; i < this.countries.length; i++) {
              for (let j = 0; j < this.countries[i].regions.length; j++) {
                if (this.countries[i].regions[j].id === id) {
                  _regions.push(this.countries[i].regions[j].title);
                  return;
                }
              }
            }
          });

          if (_regions.length > 0) {
            description += _regions.join(", ");
            description += " / ";
          }
        }

        if (description.length > 0) {
          description = description.slice(0, description.length - 3);
        }

        let stillUtc = moment.utc(search.last_run).toDate();
        let lastRun = moment(stillUtc).local().format('YYYY-MM-DD HH:mm:ss');

        return {
          id: search.id,
          userId: search.user_id,
          title: search.title,
          filters: filters,
          firms: firms,
          regions: regions,
          description: description,
          lastRun: lastRun,
          results: search.results,
        };
      }
    }
  }
</script>