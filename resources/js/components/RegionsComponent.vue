<template>
    <div id="regions">
        <region-component v-for="country in countries"
                          :country="country"
                          :key="country.id"
                          @toggleRegion="toggleRegion">
        </region-component>
    </div>
</template>

<script>
  import RegionComponent from "./RegionComponent";

  export default {
    components: {
      RegionComponent
    },
    props: {
      countries: {
        type: Array,
        default: () => []
      }
    },
    mounted() {
    },
    updated() {
    },
    methods: {
      toggleRegion: function (region) {
        this.$emit("toggleRegion", region);
      }
    }
  }
</script>