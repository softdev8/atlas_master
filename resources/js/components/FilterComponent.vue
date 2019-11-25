<template>
    <div id="filter-component">
        <saved-searches-component
                v-if="showSavedSearchesComponent"

                :searchRequest="searchRequest"

                :filters="filters"
                :firms="firms"
                :countries="countries"

                :results="results"

                @onChooseSearch="chooseSearch"

                ref="savedSearches">
        </saved-searches-component>

        <saved-projects-component
                v-if="showSavedProjectsComponent"
                :searchRequest="searchRequest"
                @onChooseProject="chooseProjectHandler"
                ref="savedProjects">
        </saved-projects-component>

        <regions-component
                :countries="countries"
                @toggleRegion="toggleRegion">
        </regions-component>

        <div class="app-filter-wrapper">
            <div class="total">
                <div class="info">
                    Total number of lawyers <span>{{total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</span>
                </div>
                <button
                        type="button"
                        class="btn btn-primary save"
                        @click="saveSearch">
                    Save
                </button>
                <button
                        type="button"
                        class="btn btn-primary save-as"
                        @click="saveSearchAs">
                    Save as...
                </button>
            </div>

            <app-filter
                    v-if="showDiskComponent"
                    v-model="searchRequest.filters"
                    :filters="filters"
                    :results="results"
                    :loading="loading"
                    @change="handleChange"
                    @submit="handleSubmit">
            </app-filter>
        </div>

        <firms-component
                :firms="firms"
                @toggleFirm="toggleFirm">
        </firms-component>

        <search-results-component
                :key="componentKey"
                v-if="showSearchResultsComponent"
                :foundCandidates="candidates"
                :chosenCandidatesIds="chosenCandidatesIds"
                :candidatesPerFirm="candidatesPerFirm"
                :candidatesPerPQE="candidatesPerPQE"
                :userId="searchRequest.user"
                :isCsv="this.isCsv"
                @onSaveProject="saveProjectHandler"
                @onSaveProjectAs="saveProjectAsHandler">
        </search-results-component>
    </div>
</template>

<script>
  import RegionsComponent from "./RegionsComponent";
  import FirmsComponent from "./FirmsComponent";
  import SearchResultsComponent from "./SearchResultsComponent";
  import SavedSearchesComponent from "./SavedSearchesComponent";
  import SavedProjectsComponent from "./SavedProjectsComponent";

  import appFilter from "./app-filter/app-filter";

  import * as searchService from "../services/search.service";
  import {compareValues} from "../utils/sorting";

  export default {
    components: {
      SavedSearchesComponent,
      SavedProjectsComponent,
      RegionsComponent,
      FirmsComponent,
      SearchResultsComponent,
      appFilter
    },
    props: ['isCsv'],
    data() {
      return {
        user: null,
        componentKey: 0,
        candidates: [],
        chosenCandidatesIds: [],
        filters: {
          levels: [],
          types: [],
          areas: [],
          specialisms: [],
          subspecialisms: []
        },
        firms: [],
        countries: [],

        showDiskComponent: false,
        showSavedSearchesComponent: false,
        showSavedProjectsComponent: false,

        timer: null,
        delay: 1000,

        candidatesPerFirm: [], // Candidates per firm: Top Results
        candidatesPerPQE: [], // Candidates per PQE: Top Results
        results: 0, // button in the component
        total: 0, // total number of lawyers,
        loading: false, // button pressed in the disk component,

        // it will be sent to backend to obtain lawyers
        searchRequest: {
          user: null,
          filters: {
            area: null,
            specialisms: [],
            subspecialisms: [],
            levels: [],
            types: []
          },
          firms: [], // selected firms
          regions: [] // selected regions
        }
      }
    },
    computed: {
      showSearchResultsComponent: function () {
        return this.candidates.length > 0;
      }
    },
    mounted() {
      // obtain initial data from backend
      this.obtainInitialData();
    },
    methods: {
      obtainInitialData: async function () {
        try {
          const initialData = await searchService.obtainInitialData();
          this.setInitialData(initialData);
          this.prepareSearchRequest();
          this.search(false);
        } catch (err) {
        }
      },
      setInitialData: function (data) { 
        this.user = data.user;
        this.filters = {
          levels: data.filters.levels.sort(compareValues("id")),
          types: data.filters.types,
          areas: data.filters.areas,
          specialisms: data.filters.specialisms,
          subspecialisms: data.filters.subspecialisms,
        };
        this.firms = this.prepareFirms(data.firms);
        this.countries = this.prepareCountries(data.countries);
      },
      prepareFirms: function (firms) {
        return firms.map(firm => ({
          ...firm,
          total: 0,
          isActive: false
        }));
      },
      prepareCountries: function (countries) {
        return countries.map(country => {
          return {
            ...country,
            regions: country.regions.map(region => ({
              ...region,
              total: 0,
              isActive: false
            }))
          }
        });
      },

      prepareSearchRequest: function () {
        // set user id
        this.searchRequest.user = this.user.id;

        // make firms and regions an empty arrays by default
        this.searchRequest.firms = [];
        this.searchRequest.regions = [];

        // prepare filters to pass it into disk component

        // pick zero-element by default
        // Practice area id
        this.searchRequest.filters.area = this.filters.areas[0].id;

        // pick zero-element by default
        // PQE levels ids
        this.searchRequest.filters.levels = [
          this.filters.levels[0].id,
          this.filters.levels[1].id,
          this.filters.levels[2].id,
          this.filters.levels[3].id,
          this.filters.levels[4].id,
          this.filters.levels[5].id,
        ];

        // find first element with non-zero id, because 0 means "All"
        // firm types ids

        // this.searchRequest.filters.types = [
        //   this.filters.types.find(element => element.id > 0).id
        // ];

        this.searchRequest.filters.types = [0];
        // pick all-element by default
        this.searchRequest.filters.specialisms = [0]; // id 0 => All
        this.searchRequest.filters.subspecialisms = [0]; // id 0 => All

        // now we can render disk-component
        this.showDiskComponent = true;

        // now we can render saved-searches-component (userId is necessary)
        this.showSavedSearchesComponent = true;

        // now we can render saved-projects-component (userId is necessary)
        this.showSavedProjectsComponent = true;
      },

      toggleItemInArray: function (collection, item) {
        const idx = collection.indexOf(item);
        if (idx !== -1) {
          collection.splice(idx, 1);
        } else {
          collection.push(item);
        }
      },

      toggleFirm: function (firm) {
        for (let i = 0; i < this.firms.length; i++) {
          if (this.firms[i].id === firm.id) {
            this.firms[i].isActive = !this.firms[i].isActive;
            this.prepareSelectedFirms();
            this.handleChange();
            return;
          }
        }
      },
      prepareSelectedFirms: function () {
        // clear
        this.searchRequest.firms = [];

        // fill the actual identifiers before submitting
        for (let i = 0; i < this.firms.length; i++) {
          if (this.firms[i].isActive) {
            this.searchRequest.firms.push(this.firms[i].id);
          }
        }
      },
      toggleRegion: function (region) {
        for (let i = 0; i < this.countries.length; i++) {
          if (this.countries[i].id === region.country_id) {
            for (let j = 0; j < this.countries[i].regions.length; j++) {
              if (this.countries[i].regions[j].id === region.id) {
                this.countries[i].regions[j].isActive = !this.countries[i].regions[j].isActive;
                this.prepareSelectedRegions();
                this.handleChange();
                return;
              }
            }
          }
        }
      },
      prepareSelectedRegions: function () {
        // clear
        this.searchRequest.regions = [];

        // fill the actual identifiers before submitting
        for (let i = 0; i < this.countries.length; i++) {
          for (let j = 0; j < this.countries[i].regions.length; j++) {
            if (this.countries[i].regions[j].isActive) {
              this.searchRequest.regions.push(this.countries[i].regions[j].id);
            }
          }
        }
      },

      beforeSubmit: function (searchRequest) {
        // remove "All" modifiers with id 0
        const request = {
          user: searchRequest.user,
          filters: {
            area: searchRequest.filters.area,
            specialisms: searchRequest.filters.specialisms.filter(id => id > 0),
            subspecialisms: searchRequest.filters.subspecialisms.filter(id => id > 0),
            levels: searchRequest.filters.levels,
            types: searchRequest.filters.types.filter(id => id > 0),
          },
          firms: searchRequest.firms,
          regions: searchRequest.regions,
        };
        return request;
      },
      handleChange: function () {
        if (this.timer) {
          clearTimeout(this.timer);
        }

        this.timer = setTimeout(() => {
          this.search(false);
        }, this.delay);
      },
      handleSubmit: function () {
        // reset chosen candidates ids
        this.chosenCandidatesIds = [];

        if (this.timer) {
          clearTimeout(this.timer);
        }

        this.search();
      },
      search: async function (refreshSearchResults = true) {
        const request = this.beforeSubmit(this.searchRequest);

        try {
          if (refreshSearchResults) {
            this.loading = true;
          }

          const data = await searchService.search(request);

          // button in the component
          this.results = data.candidates_selected;

          // total number of lawyers
          this.total = data.candidates_total;

          // clear firms counters
          for (let i = 0; i < this.firms.length; i++) {
            this.firms[i].total = 0;
          }
          // refresh firms
          data.firms.forEach(firm => {
            const firmId = firm.id;
            const index = this.firms.findIndex(firm => firm.id === firmId);
            if (index !== -1) {
              this.firms[index].total = firm.total;
            }
          });

          // clear regions counters
          for (let i = 0; i < this.countries.length; i++) {
            for (let j = 0; j < this.countries[i].regions.length; j++) {
              this.countries[i].regions[j].total = 0;
            }
          }
          // refresh regions
          data.regions.forEach(region => {
            const countryId = region.country_id;
            const countryIndex = this.countries.findIndex(country => country.id === countryId);

            if (countryIndex !== -1) {
              for (let i = 0; i < this.countries[countryIndex].regions.length; i++) {
                if (this.countries[countryIndex].regions[i].id === region.id) {
                  this.countries[countryIndex].regions[i].total += region.total;
                  break;
                }
              }
            }
          });

          if (refreshSearchResults) {
            this.candidates = data.candidates.map(candidate => {

              let _subspecialism = "";
              let _specialism = "";
              let _practiceArea = "";

              let subspecialismIds = [];
              let specialismIds = [];
              let practiceAreaIds = [];

              candidate.specialisms.forEach(specialism => {

                if (subspecialismIds.findIndex(id => {
                  return id === specialism.subspecialism_id;
                }) === -1) {
                  if (specialism.subspecialism_id) {
                    subspecialismIds.push(specialism.subspecialism_id);
                  }
                }

                if (specialismIds.findIndex(id => {
                  return id === specialism.specialism_id;
                }) === -1) {
                  if (specialism.specialism_id) {
                    specialismIds.push(specialism.specialism_id);
                  }
                }

                if (practiceAreaIds.findIndex(id => {
                  return id === specialism.area_id;
                }) === -1) {
                  if (specialism.area_id) {
                    practiceAreaIds.push(specialism.area_id);
                  }
                }
              });

              subspecialismIds.forEach(subspecialismId => {
                _subspecialism = _subspecialism + this.filters.subspecialisms
                  .find(element => subspecialismId === element.id)
                  .title + ", ";
              });

              specialismIds.forEach(specialismId => {
                _specialism = _specialism + this.filters.specialisms.find(element => {
                  return specialismId === element.id;
                }).title + ", ";
              });

              practiceAreaIds.forEach(practiceAreaId => {
                _practiceArea = _practiceArea + this.filters.areas.find(element => {
                  return practiceAreaId === element.id;
                }).title + ", ";
              });

              return {
                subspecialism: _subspecialism.length > 0 ? _subspecialism.slice(0, _subspecialism.length - 2) : "",
                specialism: _specialism.length > 0 ? _specialism.slice(0, _specialism.length - 2) : "",
                practiceArea: _practiceArea.length > 0 ? _practiceArea.slice(0, _practiceArea.length - 2) : "",
                ...candidate,
              }
            });

            // Candidates per firm: Top Results
            data.firms.sort(compareValues("total", "desc"));
            this.candidatesPerFirm = data.firms.map(firm => {
              return {
                label: firm.title,
                value: firm.total
              }
            });

            // Candidates per PQE: Top Results
            let pqe = [];
            for (let prop in data.pqe) {
              pqe.push({
                pqe: +prop,
                value: data.pqe[prop]
              });
            }
            pqe.sort(compareValues("pqe", "desc"));
            this.candidatesPerPQE = pqe.map(element => {
              return {
                label: `PQE ${element.pqe}`,
                value: element.value
              }
            });

            this.componentKey += 1;
            this.loading = false;

            setTimeout(() => {
              $("html, body").animate({
                scrollTop: ($("#search-results").offset().top)
              }, 500);
            }, 300);
          }

          this.$refs.savedSearches.setLastRun();
        } catch (err) {
        }
      },

      saveSearch: function () {
        this.$refs.savedSearches.saveSearch();
      },
      saveSearchAs: function () {
        this.$refs.savedSearches.saveAs();
      },

      chooseSearch: function (search) {
        // Set practice area id
        this.searchRequest.filters.area = search.filters.area;

        // Set PQE levels ids
        this.searchRequest.filters.levels = search.filters.levels;

        // Set specialisms ids
        this.searchRequest.filters.specialisms = search.filters.specialisms;

        // Set subspecialisms ids
        this.searchRequest.filters.subspecialisms = search.filters.subspecialisms;

        // Set firm types ids
        this.searchRequest.filters.types = search.filters.types;

        // Set firms ids
        for (let i = 0; i < this.firms.length; i++) {
          const index = search.firms.findIndex(id => id === this.firms[i].id);
          this.firms[i].isActive = index !== -1;
        }
        this.prepareSelectedFirms();

        // Set regions ids
        for (let i = 0; i < this.countries.length; i++) {
          for (let j = 0; j < this.countries[i].regions.length; j++) {
            const index = search.regions.findIndex(id => id === this.countries[i].regions[j].id);
            this.countries[i].regions[j].isActive = index !== -1;
          }
        }
        this.prepareSelectedRegions();

        this.handleChange();
      },

      setCriterias: function (criterias) {
        // Set practice area id
        this.searchRequest.filters.area = criterias.filters.area;

        // Set PQE levels ids
        this.searchRequest.filters.levels = criterias.filters.levels;

        // Set specialisms ids
        this.searchRequest.filters.specialisms = criterias.filters.specialisms;

        // Set subspecialisms ids
        this.searchRequest.filters.subspecialisms = criterias.filters.subspecialisms;

        // Set firm types ids
        this.searchRequest.filters.types = criterias.filters.types;

        // Set firms ids
        for (let i = 0; i < this.firms.length; i++) {
          const index = criterias.firms.findIndex(id => id === this.firms[i].id);
          this.firms[i].isActive = index !== -1;
        }
        this.prepareSelectedFirms();

        // Set regions ids
        for (let i = 0; i < this.countries.length; i++) {
          for (let j = 0; j < this.countries[i].regions.length; j++) {
            const index = criterias.regions.findIndex(id => id === this.countries[i].regions[j].id);
            this.countries[i].regions[j].isActive = index !== -1;
          }
        }
        this.prepareSelectedRegions();

        if (this.timer) {
          clearTimeout(this.timer);
        }

        this.search();
      },

      saveProjectHandler: function (selectedCandidates) {
        this.$refs.savedProjects.saveProject(selectedCandidates);
      },
      saveProjectAsHandler: function (selectedCandidates) {
        this.$refs.savedProjects.showSaveAsModal(selectedCandidates);
      },
      chooseProjectHandler: function (project) {
        this.chosenCandidatesIds = project.candidates;
        this.setCriterias(project);
      }
    }
  }
</script>