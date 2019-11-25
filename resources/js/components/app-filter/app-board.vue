<template>
    <div class="app-board">
        <ul class="app-board-options">
            <li v-for="(val, key) in filters" :key="key" :style="zIndexForPosition[key]">
                <span :style="rotateForPosition[key].value">
                    <input type="checkbox" :id="name + val.id" :value="val.id" v-model="selected">
                    <label :for="name + val.id">{{ val.title }}</label>
                </span>
                <i :style="rotateForPosition[key].border"></i>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: [Array],
            default: null,
        },
        filters: {
            type: Array,
            required: true,
        },
        name: {
            type: String,
            required: true,
            default: () => Math.floor(Math.random() * 1000000).toString(),
        },
    },

  
    data() {      
        return {
            sector: {
                angle: 40,
            },
            total_val: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            isSelectdAll: false,
        }
    },
    watch: {
        value: function (val) {
         if(val.length < 12) {
             this.isSelectdAll = false;
         }
        }
    },

    computed: {
        selected: { 
            get() {
                return this.value ? [...this.value] : []
            },

            set(val) {       
                if (val.indexOf(11) !== -1 && !this.isSelectdAll ) {
                    val = this.total_val                    
                    this.isSelectdAll = true;
                } else if (this.isSelectdAll && val.indexOf(11) !== -1) {
                    let index = val.indexOf(11);
                    if (index > -1) {
                        val.splice(index, 1);
                    }
                    this.isSelectdAll = false                   
                } else if (val.indexOf(11) == -1 && val.length == 11) {
                    val=[-2]
                }

                this.$emit('input', val)
                this.$emit('change', val)
            },
        },

        rotateForPosition() {
            let rotate = []

            const angle_start = this.sector.angle / 2
            const angle_option = this.sector.angle / (this.filters.length - 1);
            const angle_border = angle_option / 2;

            for (let pos = 0; pos < this.filters.length; pos++) {
                let deg = angle_start - pos * angle_option

                rotate.push({
                    value: {
                        transform: 'rotateZ(' + deg + 'deg)'
                    },
                    border: {
                        transform: 'translateX(-50%) rotateZ(' + (deg - angle_border) + 'deg)'
                    },
                })
            }

            return rotate
        },

      zIndexForPosition() {
        let z_index = []
        const halfLenght = Math.floor(this.filters.length / 2)

        for (let pos = 0; pos < this.filters.length; pos++) {
          z_index.push({zIndex: halfLenght - Math.abs(halfLenght - pos)})
        }

        return z_index
      },
    },
}
</script>

<style lang="scss">
.app-board {
    $R: 600px;

    height: 24px;
    user-select: none;

    .app-board-options {
        position: relative;

        li {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            height: 0;

            span {
                position: relative;
                display: inline-block;
                width: 32px;
                text-align: center;
                line-height: 24px;
                transform-origin: 50% #{-$R};
                transform: rotateZ(20deg);

                input[type=checkbox] {
                    display: none;

                    &+label {
                        width: 100%;
                        height: 100%;
                        width: 100%;
                        line-height: 24px;
                        font-weight: bold;
                        font-size: 17px;
                        text-align: center;
                        display: inline-block;
                        color: #ccc;
                        cursor: pointer;
                        user-select: none;
                    }

                    &:checked {
                        &+label {
                            color: #00218E;
                        }
                    }
                }
            }

            i {
                display: inline-block;
                width: 2px;
                height: 24px;
                position: absolute;
                top: 0;
                left: 50%;
                font-style: normal;
                background: transparentize(#000, .75);
                
                transform-origin: 50% #{-$R};
            }

            &:last-child {
                i {
                    display: none;
                }
            }

            $angle-sector: 40deg;
            $angle-start: $angle-sector / 2;

            $options-count: 11;
            $angle-option: $angle-sector / ($options-count - 1);

            // @for $n from 1 through $options-count {
            //     &:nth-child(#{$n}) span {
            //         transform: rotateZ(#{$angle-start - ($angle-option * ($n - 1))});
            //     }
            // }

            // @for $n from 1 through $options-count {
            //     &:nth-child(#{$n}) i {
            //         // transform: translateX(-50%) rotateZ(#{
            //         //     ( $angle-start - ($angle-option * ($n - 1)) )
            //         //     - ($angle-option / 2)
            //         // });
            //         transform: translateX(-50%) rotateZ(#{ $angle-start - $angle-option * ($n - 1/2) });
            //     }
            // }
        }
    }
}
</style>

