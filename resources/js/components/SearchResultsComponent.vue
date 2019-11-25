<template>
    <div id="search-results">
        <popup-component
            :show="showIncorrectRecordPopup"
            :title="'Would you like to suggest an edit?'"
            @onClose="closeIncorrectRecordModal">
            <div v-if="incorrectRecordLoading" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form
                v-if="!incorrectRecordLoading && !showCongratulationsMessage"
                @submit.prevent="report">
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <textarea
                            v-model="comment"
                            class="form-control"
                            rows="3"
                            :class="{'validation-error': commentValidationError}"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-2 offset-sm-3">
                        <button type="submit" class="btn btn-danger btn-block">
                            Submit
                        </button>
                    </div>
                    <div class="form-group col-sm-2 offset-sm-2">
                        <button type="button" class="btn btn-primary btn-block" @click="closeIncorrectRecordModal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
            <div v-if="!incorrectRecordLoading && showCongratulationsMessage"
                 class="congratulations-message">
                <span>
                    {{congratulationsMessage}}
                </span>
                <img src="img/ok.svg" alt="">
            </div>
        </popup-component>

        <div class="matched">
            <div class="info">
                <span>{{candidatesMatched}}</span> candidates matched
            </div>
        </div>

        <div class="filters">

            <div class="job-title">
                <span>Job title:</span>
                <div class="select">
                    <ul>
                        <li
                            v-for="jobTitle in filters.jobTitle"
                            :class="{active: isActiveFilter(selectedFilters.jobTitle, jobTitle)}"
                            @click="toggleJobTitle(jobTitle)">
                            {{jobTitle}}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="word-search">
                <!-- The submit event will no longer reload the page -->
                <form @submit.prevent="handleSubmit">
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <span>Keyword search:</span>
                        </div>
                        <div class="form-group col-sm-6">
                            <input
                                ref="search"
                                type="text"
                                class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-sm-3">
                            <button type="submit" class="btn btn-primary btn-block">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="sorting">
            <span class="order-by">Order by:</span>

            <button
                type="button"
                class="btn btn-primary"
                @click="changeSorting('surname')">
                Surname
                <i
                    class="fa fa-arrow-up"
                    aria-hidden="true"
                    v-if="orderBy === 'surname' && direction === 1">
                </i>
                <i
                    class="fa fa-arrow-down"
                    aria-hidden="true"
                    v-if="orderBy === 'surname' && direction === -1">
                </i>
            </button>

            <button
                type="button"
                class="btn btn-primary"
                @click="changeSorting('pqe')">
                PQE
                <i
                    class="fa fa-arrow-up"
                    aria-hidden="true"
                    v-if="orderBy === 'pqe' && direction === 1">
                </i>
                <i
                    class="fa fa-arrow-down"
                    aria-hidden="true"
                    v-if="orderBy === 'pqe' && direction === -1">
                </i>
            </button>

            <button
                type="button"
                class="btn btn-primary"
                @click="changeSorting('firm.title')">
                Firm
                <i
                    class="fa fa-arrow-up"
                    aria-hidden="true"
                    v-if="orderBy === 'firm.title' && direction === 1">
                </i>
                <i
                    class="fa fa-arrow-down"
                    aria-hidden="true"
                    v-if="orderBy === 'firm.title' && direction === -1">
                </i>
            </button>

            <button
                type="button"
                class="btn btn-primary"
                @click="changeSortingExtended('firm.type', [1, 2, 3, 5, 4, 10], 'firm.ranking')">
                Firm ranking
                <i
                    class="fa fa-arrow-up"
                    aria-hidden="true"
                    v-if="orderBy === 'firm.type' && direction === 1">
                </i>
                <i
                    class="fa fa-arrow-down"
                    aria-hidden="true"
                    v-if="orderBy === 'firm.type' && direction === -1">
                </i>
            </button>

            <div class="float-right">
                <button
                    v-if="selectedCandidatesOnCurrentPage === 0"
                    type="button"
                    class="btn btn-primary select-all"
                    @click="changeSelection(true)">
                    Select all
                </button>
                <button
                    v-else
                    type="button"
                    class="btn btn-primary select-all"
                    @click="changeSelection(false)">
                    Unselect all
                </button>

                <button
                    v-if="!candidatesExpanded"
                    type="button"
                    class="btn btn-primary expand-all"
                    @click="expandAll(true)">
                    Expand all
                </button>
                <button
                    v-else
                    type="button"
                    class="btn btn-primary expand-all"
                    @click="expandAll(false)">
                    Collapse all
                </button>
            </div>
        </div>

        <div class="selected">
            <div class="info">
                <span>{{selectedCandidates}}</span> selected of <span>{{candidatesMatched}}</span> candidates
            </div>
            <button
                type="button"
                class="btn btn-primary save"
                @click="saveProject">
                Save
            </button>
            <button
                type="button"
                class="btn btn-primary save-as"
                @click="saveProjectAs">
                Save as...
            </button>
            <div class="export" v-if="selectedCandidates > 0 && this.isCsv === 1">
                <button
                    v-if="!exportCandidatesLoading"
                    type="button"
                    class="btn btn-primary"
                    @click.stop="exportCandidates()">
                    Export
                </button>
                <div
                    v-else
                    class="spinner-border text-primary"
                    role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div
            class="search-results-pagination"
            v-if="totalPages > 0">
            <div class="pages">
                Page <span>{{currentPage}}</span> of <span>{{totalPages}}</span>

                <div class="per-page-controls">
                    Per page:
                    <button
                        v-for="pageSizeNumber in pageSizes"
                        type="button"
                        @click="changePageSize(pageSizeNumber)"
                        class="btn per-page"
                        v-bind:class="{ 'btn-primary': pageSizeNumber === pageSize, 'btn-outline-primary': pageSizeNumber !== pageSize }"
                    >
                        {{ pageSizeNumber }}
                    </button>
                </div>
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

        <div class="candidates">
            <div v-for="candidate in paginatedCandidates" class="candidate">
                <div :href="'#' + 'candidate-' + candidate.id" data-toggle="collapse" class="header" v-bind:class="{ collapse: !candidatesExpanded }">
                    <div class="name">
                        <i
                            class="fa fa-check"
                            @click.stop="toggleCandidate(candidate)"
                            aria-hidden="true"
                            v-if="candidate.isActive">
                        </i>
                        <i
                            class="fa fa-times"
                            @click.stop="toggleCandidate(candidate)"
                            aria-hidden="true"
                            v-if="!candidate.isActive">
                        </i>
                        {{candidate.forename}} {{candidate.surname}}
                    </div>
                    <div class="details">
                        PQE: <span>{{candidate.pqe}}</span>, Firm: <span>{{candidate.firm.title}}</span>, Firm ranking:
                        <span class="firmranking">{{candidate.firm.ranking}}</span>
                        <i></i>
                        <span class="linkedin">
                            <a class="icon-position" :href="candidate.linked_in"  @click.stop="activityLogaAtion($event, candidate.linked_in, 'linkedin')">
                                <img width="25" :src="candidate.linked_in && require('../../../public/img/linkedin-icon.png')"/>
                            </a>
                        </span>
                        <span >
                            <a class="icon-position" :href="candidate.website"  @click.stop="activityLogaAtion($event, candidate.website, 'firmlink')">
                                <img width="25" :src="candidate.website && require('../../../public/img/user-icon.png')"/>
                            </a>
                        </span>
                    </div>
                </div>
                <div :id="'candidate-' + candidate.id" class="body" v-bind:class="{ collapse: !candidatesExpanded }">
                    <button
                        type="button"
                        @click="suggestAnEdit(candidate)"
                        class="btn btn-primary suggest-an-edit">
                        Suggest an edit
                    </button>
                    <div class="item">
                        <div class="key">
                            Forename:
                        </div>
                        <div class="value">
                            {{candidate.forename}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Surname:
                        </div>
                        <div class="value">
                            {{candidate.surname}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Firm:
                        </div>
                        <div class="value">
                            {{candidate.firm.title}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Firm ranking:
                        </div>
                        <div class="value">
                            {{candidate.firm.ranking}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Admitted Date:
                        </div>
                        <div class="value">
                            {{candidate.admitted_date}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            PQE:
                        </div>
                        <div class="value">
                            {{candidate.pqe}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Contact number:
                        </div>
                        <div class="value">
                            {{candidate.workphone}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Email address:
                        </div>
                        <div class="value">
                            <a :href="'mailto:' + candidate.email">Email</a>
                        </div>
                    </div>                    
                    <div class="item" v-if="candidate.linked_in">
                        <div class="key">
                            LinkedIn:
                        </div>
                        <div class="value">
                            <a target="_blank" :href="candidate.linked_in" @click.stop="activityLogaAtion($event, candidate.linked_in, 'linkedin')">LinkedIn</a>
                        </div>
                    </div>
                    <div class="item" v-if="candidate.website">
                        <div class="key">
                            Firm profile:
                        </div>
                        <div class="value">
                            <a target="_blank" :href="candidate.website" @click.stop="activityLogaAtion($event, candidate.website, 'firmlink')">Link</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Law society Link:
                        </div>
                        <div class="value">
                            <a target="_blank" :href="candidate.law_society_link">Law society Link</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Country:
                        </div>
                        <div class="value">
                            {{country(candidate)}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Region:
                        </div>
                        <div class="value">
                            {{region(candidate)}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            City:
                        </div>
                        <div class="value">
                            {{city(candidate)}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Title:
                        </div>
                        <div class="value">
                            {{candidate.job_title}}
                        </div>
                    </div>
                    <div class="item" v-if="candidate.subspecialism.length > 0">
                        <div class="key">
                            Subspecialism:
                        </div>
                        <div class="value">
                            {{candidate.subspecialism}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Specialism:
                        </div>
                        <div class="value">
                            {{candidate.specialism}}
                        </div>
                    </div>
                    <div class="item">
                        <div class="key">
                            Practice area:
                        </div>
                        <div class="value">
                            {{candidate.practiceArea}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="charts">
            <div class="column">
                <chart-component
                    :items="candidatesPerFirm"
                    :title="'Candidates per firm: Top Results'">
                </chart-component>
            </div>
            <div class="column">
                <chart-component
                    :items="candidatesPerPQE"
                    :title="'Candidates per PQE: Top Results'">
                </chart-component>
            </div>
        </div>
    </div>
</template>

<script>
  import { get, has } from 'lodash';
  import * as reportService from '../services/report.service';
  import * as searchService from "../services/search.service";
  import { limit, skip } from '../utils/pagination';
  import { compareValues, compareValuesExtended } from '../utils/sorting';
  import {convertArrayToCSV} from "convert-array-to-csv";

  import ChartComponent from './ChartComponent';
  import PopupComponent from './PopupComponent';

  export default {
    components: {
      ChartComponent,
      PopupComponent,
    },
    props: {
      foundCandidates: {
        type: Array,
        required: true,
      },
      chosenCandidatesIds: {
        type: Array,
        required: true,
      },
      candidatesPerFirm: {
        type: Array,
        required: true,
      },
      candidatesPerPQE: {
        type: Array,
        required: true,
      },
      userId: {
        type: Number,
        required: true,
      },
      isCsv: {
          type: Number,
          required: true,
      }
    },
    computed: {
      totalPages: function () {
        return Math.ceil(this.filteredCandidates.length / this.pageSize);
      },
      showPrevious: function () {
        return this.currentPage > 1;
      },
      showNext: function () {
        return this.currentPage < this.totalPages;
      },
      selectedCandidates: function () {
        let counter = 0;
        this.filteredCandidates.forEach(candidate => {
          if (candidate.isActive) {
            counter++;
          }
        });
        return counter;
      },
      selectedCandidatesOnCurrentPage: function () {
        let counter = 0;
        this.paginatedCandidates.forEach(candidate => {
          if (candidate.isActive) {
            counter++;
          }
        });
        return counter;
      },
      candidatesMatched: function () {
        return this.filteredCandidates.length;
      },
      filteredCandidates: function () {

        let candidates = [
          ...this.candidates,
        ];

        if (this.selectedFilters.jobTitle.length > 0) {
          candidates = candidates.filter(candidate => {
            return this.selectedFilters.jobTitle.findIndex(jobTitle => candidate.job_title === jobTitle) !== -1;
          });
        }

        // Filter by searching for such options
        const options = [
          'surname', // Surname
          'regions[0].city.title', // City title
          'firm.title', // Firm title
          'specialism', // Specialism
        ];

        if (this.search.length > 0) {

          const pattern = new RegExp(`^.*${this.search}.*$`, 'i');
          candidates = candidates.filter(candidate => {
            let result = false;

            options.forEach(option => {
              if (has(candidate, option)) {
                result = result || pattern.test(get(candidate, option));
              }
            });

            return result;
          });

        }

        return candidates;
      },
      sortedCandidates: function () {
        const candidates = [...this.filteredCandidates];
        const direction = this.direction === 1 ? 'asc' : 'desc';

        if (!this.orderByExtended) {

          return this.orderBy.length > 0 ?
            candidates.sort(compareValues(this.orderBy, direction)) : candidates;

        } else {

          return this.orderBy.length > 0 ?
            candidates.sort(compareValuesExtended(this.orderBy, this.orderByData, this.orderByAdditional, direction)) : candidates;

        }

      },
      paginatedCandidates: function () {
        return limit(skip(this.sortedCandidates, (this.currentPage - 1) * this.pageSize), this.pageSize);
        // return this.sortedCandidates;
      },
    },
    data() {
      return {
        orderBy: '',
        direction: 1,
        clicks: 0,

        orderByExtended: false,
        orderByData: [],
        orderByAdditional: '',

        search: '',

        filters: {
          jobTitle: [
            'Associate',
            'Partner',
            'PSL',
            'Consultant',
          ],
        },

        selectedFilters: {
          jobTitle: [],
        },

        currentPage: 1,
        pageSize: 10,
        pageSizes: [10, 20, 50, 100],

        candidates: [],

        incorrectRecordId: null,

        incorrectRecordLoading: false,
        showIncorrectRecordPopup: false,

        showCongratulationsMessage: false,
        congratulationsMessage: 'Thank you!',

        comment: '',
        commentValidationError: false,

        exportCandidatesLoading: false,

        candidatesExpanded: false,
      };
    },
    mounted() {
      this.candidates = [
        ...this.foundCandidates,
      ].map((candidate, index) => {
        const idx = this.chosenCandidatesIds.findIndex(id => id === candidate.id);
        return {
          ...candidate,
          isActive: idx !== -1,
          index,
        };
      });
    },
    methods: {
      country: function (candidate) {
        return has(candidate, 'regions[0].country.title') ?
          get(candidate, 'regions[0].country.title') : '';
      },
      region: function (candidate) {
        return has(candidate, 'regions[0].region.title') ?
          get(candidate, 'regions[0].region.title') : '';
      },
      city: function (candidate) {
        return has(candidate, 'regions[0].city.title') ?
          get(candidate, 'regions[0].city.title') : '';
      },
      changeSorting: function (orderBy) {
        if (this.orderBy === orderBy) {
          this.direction *= -1;
          this.clicks++;
        } else {
          this.orderBy = orderBy;
          this.direction = 1;
          this.clicks = 0;
        }

        if (this.clicks > 1) {
          this.orderBy = '';
          this.direction = 1;
          this.clicks = 0;
        }

        this.orderByExtended = false;
      },
      changeSortingExtended: function (orderBy, orderByDataArray, additionalOrderBy) {
        this.changeSorting(orderBy);

        this.orderByExtended = true;
        this.orderByAdditional = additionalOrderBy;
        this.orderByData = orderByDataArray;
      },
      previousPage: function () {
        this.currentPage -= 1;
      },
      nextPage: function () {
        this.currentPage += 1;
      },
      changePageSize: function (pageSize) {
        this.pageSize = pageSize;
      },
      toggleCandidate: function (candidate) {
        this.candidates[candidate.index].isActive = !this.candidates[candidate.index].isActive;
      },
      toggleJobTitle: function (jobTitle) {
        this.currentPage = 1;

        const idx = this.selectedFilters.jobTitle.findIndex(element => element === jobTitle);
        if (idx !== -1) {
          this.selectedFilters.jobTitle.splice(idx, 1);
        } else {
          this.selectedFilters.jobTitle.push(jobTitle);
        }
      },
      isActiveFilter: function (collection, item) {
        return collection.findIndex(element => element === item) !== -1;
      },
      handleSubmit: function () {
        this.search = this.$refs.search.value.trim();
      },
      saveProject: function () {
        const selectedCandidates = this.filteredCandidates
          .filter(candidate => candidate.isActive)
          .map(candidate => candidate.id);
        this.$emit('onSaveProject', selectedCandidates);
      },
      saveProjectAs: function () {
        const selectedCandidates = this.filteredCandidates
          .filter(candidate => candidate.isActive)
          .map(candidate => candidate.id);
        this.$emit('onSaveProjectAs', selectedCandidates);
      },
      changeSelection: function (isActive) {
        this.paginatedCandidates.forEach(candidate => {
          candidate.isActive = isActive;
        });
      },
      expandAll: function (expandAll) {
        this.candidatesExpanded = expandAll;
      },
      suggestAnEdit: function (candidate) {
        this.incorrectRecordId = candidate.id;
        this.showIncorrectRecordModal();
      },

      closeIncorrectRecordModal: function () {
        if (this.incorrectRecordLoading === false) {
          this.showIncorrectRecordPopup = false;
        }
      },
      showIncorrectRecordModal: function () {
        this.comment = '';
        this.commentValidationError = false;
        this.showCongratulationsMessage = false;
        this.showIncorrectRecordPopup = true;
      },

      report: async function () {
        if (this.comment.trim().length > 0) {
          this.commentValidationError = false;

          const request = {
            user_id: this.userId,
            candidate_id: this.incorrectRecordId,
            description: this.comment,
          };

          try {
            this.incorrectRecordLoading = true;

            const data = await reportService.report(request);

            this.incorrectRecordLoading = false;
            this.showCongratulationsMessage = true;

            setTimeout(() => {
              this.closeIncorrectRecordModal();
            }, 5 * 1000);
          } catch (err) {
            this.incorrectRecordLoading = false;
          }
        } else {
          this.commentValidationError = true;
        }
      },

      exportCandidates: async function () {

        // we can handle only one stream
        if (this.exportCandidatesLoading === false) {

          let selectedCandidates = this.filteredCandidates
            .filter(candidate => candidate.isActive)
            .map(candidate => candidate.id);

          if (selectedCandidates.length > 0) {
            const params = {
              user_id: this.userId,
              selected_candidates_ids: selectedCandidates
            };

            try {
              this.exportCandidatesLoading = true;

              const data = await searchService.exportToCSV(params);
              this.exportCandidatesToCSV(data);

              this.exportCandidatesLoading = false;
            } catch (err) {
              this.exportCandidatesLoading = false;
            }
          }
        }
      },
      openNewTabInBackground: url => {
         window.open(url, '_blank')
      },
      exportCandidatesToCSV: function (data) {
        const header = [
          'Firm',
          'Forename',
          'Surname',
          'Region',
          'Cities',
          'Admitted date',
          'PQE',
          'Phone number',
          'Mobile number',
          'Email address',
          'Firm profile',
          'LinkedIn',
          'Practice areas',
          'Specialisms',
          'Sub-specialisms',
          'Title',
        ];

        let dataArrays = [];

        data.candidates.forEach(candidate => {
          let practiceAreas = '';
          candidate.areas_details.forEach(item => {
            practiceAreas += item.title;
            practiceAreas += ', ';
          });
          practiceAreas = practiceAreas.slice(0, practiceAreas.length - 2);

          let specialisms = '';
          candidate.specialisms_details.forEach(item => {
            specialisms += item.title;
            specialisms += ', ';
          });
          specialisms = specialisms.slice(0, specialisms.length - 2);

          let subSpecialisms = '';
          candidate.sub_specialisms_details.forEach(item => {
            subSpecialisms += item.title;
            subSpecialisms += ', ';
          });
          subSpecialisms = subSpecialisms.slice(0, subSpecialisms.length - 2);

          const regions = candidate.regions.map(region => region.region.title).join(',');
          const cities = candidate.regions.map(region => region.city.title).join(',');
          
          let row = [
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
          separator: ',',
        });

        var csvContent = new Blob([csvFromArrayOfArrays], {type: 'text/csv;charset=utf-8;'});
        var encodedURI = URL.createObjectURL(csvContent);

        const link = document.createElement('a');

        const curDate = new Date();
        const curDateTimeString = curDate.toLocaleDateString() + '-' + curDate.toLocaleTimeString();

        link.setAttribute('href', encodedURI);
        link.setAttribute('download', `export-${curDateTimeString}.csv`);

        document.body.appendChild(link); // Required for FF

        link.click();
      },
      activityLogaAtion: async function(e, link, actionName) {
        e.preventDefault();

        if (link) {
          const params = {actionName: actionName};
          const data = await searchService.LogLinkclickAction(params);
          if (data.log_updated) {
            window.open(link, '_blank')
            window.focus()
          }
        }        
      }
    },
  };
</script>
