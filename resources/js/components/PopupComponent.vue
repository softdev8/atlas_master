<template>
    <div class="overlay" :class="{ show: show }" @click="handleClose">
        <div class="popup" @click.stop>
            <div class="popup-head">
                {{title}}
            </div>
            <div class="popup-body">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    components: {},
    props: {
      show: {
        type: Boolean,
        required: true
      },
      title: {
        type: String,
        required: true
      }
    },
    computed: {
      getScrollbarWidth: function () {
        return window.innerWidth - document.documentElement.clientWidth;
      }
    },
    data() {
      return {}
    },
    mounted() {
    },
    watch: {
      show: function () {
        const body = $("body");

        if (this.show) {
          body.css("padding-right", this.getScrollbarWidth + "px");
          body.css("overflow", "hidden");
        } else {
          setTimeout(() => {
            body.css("padding-right", "");
            body.css("overflow", "");
          }, 300);
        }
      }
    },
    updated() {
    },
    methods: {
      handleClose: function () {
        this.$emit("onClose");
      }
    }
  }
</script>