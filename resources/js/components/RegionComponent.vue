<template>
    <div class="region">
        <div
                :href="'#' + 'region-list-' + country.id"
                data-toggle="collapse"
                class="region-header"
                :class="{ empty: !showRegions }">
            <div class="country" @click.stop="changeSorting('title')">
                {{country.title}}
                <i
                        class="fa fa-arrow-up"
                        aria-hidden="true"
                        v-if="orderBy === 'title' && direction === 1">
                </i>
                <i
                        class="fa fa-arrow-down"
                        aria-hidden="true"
                        v-if="orderBy === 'title' && direction === -1">
                </i>
            </div>
            <div class="results" @click.stop="changeSorting('total')">
                {{total}}
                <i
                        class="fa fa-arrow-up"
                        aria-hidden="true"
                        v-if="orderBy === 'total' && direction === 1">
                </i>
                <i
                        class="fa fa-arrow-down"
                        aria-hidden="true"
                        v-if="orderBy === 'total' && direction === -1">
                </i>
            </div>
        </div>
        <div v-if="showRegions" :id="'region-list-' + country.id" class="region-list collapse show">
            <ul>
                <li v-for="region in sortedRegions"
                    :class="{ active: region.isActive }"
                    @click="toggleRegion(region)">
                    <div class="city">
                        {{region.title}}
                    </div>
                    <div class="total">
                        {{region.total}}
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
  import {compareValues} from "../utils/sorting";

  export default {
    props: {
      country: {
        type: Object,
        required: true
      }
    },
    computed: {
      showRegions: function () {
        return this.country.regions.length > 0;
      },
      total: function () {
        let total = 0;
        this.country.regions.forEach(region => total += region.total);
        return total;
      },
      sortedRegions: function () {
        const regions = [...this.country.regions];
        const direction = this.direction === 1 ? "asc" : "desc";
        return this.orderBy.length > 0 ?
          regions.sort(compareValues(this.orderBy, direction)) : regions;
      }
    },
    data() {
      return {
        orderBy: "",
        direction: 1,
        clicks: 0
      }
    },
    mounted() {
    },
    updated() {
    },
    methods: {
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
          this.orderBy = "";
          this.direction = 1;
          this.clicks = 0;
        }
      },
      toggleRegion: function (region) {
        this.$emit("toggleRegion", region);
      }
    }
  }
</script>