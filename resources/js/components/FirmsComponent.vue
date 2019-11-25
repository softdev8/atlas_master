<template>
    <div id="firms">
        <div
                href="#firms-list"
                data-toggle="collapse"
                class="firms-header"
                :class="{ empty: !showFirms }">
            <div class="title" @click.stop="changeSorting('title')">
                Firm name
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
        <div v-if="showFirms" id="firms-list" class="firms-list collapse show">
            <ul>
                <li v-for="firm in sortedFirms"
                    :class="{ active: firm.isActive }"
                    @click="toggleFirm(firm)"
                    @mouseover="handleMouseover($event, firm)"
                    @mouseleave="handleMouseleave">
                    <div class="firm">
                        {{firm.title}}
                    </div>
                    <div class="total">
                        {{firm.total}}
                    </div>
                </li>
            </ul>
        </div>
        <div ref="salaryInfo" class="salary-info">
            <div class="salary-header">
                {{firm.title}}
            </div>
            <div class="salary-table">
                <div class="salary-row heading">
                    <span>PQE</span>
                    <span>Salary</span>
                </div>
                <div v-for="salary in firm.salaries" class="salary-row">
                    <span>{{salary.pqe}}</span>
                    <span>&#163;{{salary.min}} - &#163;{{salary.max}}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import {compareValues} from "../utils/sorting";

  export default {
    props: {
      firms: {
        type: Array,
        default: () => []
      }
    },
    computed: {
      showFirms: function () {
        return this.firms.length > 0;
      },
      total: function () {
        let total = 0;
        this.firms.forEach(firm => total += firm.total);
        return total;
      },
      sortedFirms: function () {
        const firms = [...this.firms];
        const direction = this.direction === 1 ? "asc" : "desc";
        return this.orderBy.length > 0 ?
          firms.sort(compareValues(this.orderBy, direction)) : firms;
      },
    },
    data() {
      return {
        orderBy: "",
        direction: 1,
        clicks: 0,
        firm: {
          title: "",
          salaries: [],
        },
      }
    },
    mounted() {
    },
    methods: {
      getCoords: function (elem) {
        const {top} = elem.getBoundingClientRect();

        return {
          top: top + pageYOffset - document.getElementById("firms").offsetTop
        };
      },
      handleMouseover: function (event, firm) {
        if (firm.salaries.length > 0) {
          const elem = event.target.tagName.toLowerCase() === "li" ?
            event.target : event.target.parentNode;
          const {top} = this.getCoords(elem);

          this.firm.title = firm.title;
          this.firm.salaries = firm.salaries;

          this.$refs.salaryInfo.style.top = `${top}px`;
          this.$refs.salaryInfo.style.display = "block";
        }
      },
      handleMouseleave: function () {
        this.$refs.salaryInfo.style.display = "none";
      },
      showSalaryInfo: function (firm) {
        return firm.salaries.length > 0;
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
          this.orderBy = "";
          this.direction = 1;
          this.clicks = 0;
        }
      },
      toggleFirm: function (firm) {
        this.$emit("toggleFirm", firm);
      }
    }
  }
</script>