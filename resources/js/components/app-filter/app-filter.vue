<template>
    <div class="app-filter" :class="{'app-filter-loading': loading}">
        <div class="app-filter-bg">
            <div class="dials"></div>
            <div class="levels"></div>
        </div>

        <div class="app-filter-dials">
            <app-dial class="dial dial-areas" v-model="value.area" :filters="areas" :multi="false" name="areas"></app-dial>

            <app-dial class="dial dial-specialisms" v-model="value.specialisms" :filters="specialisms" :multi="true" name="specialisms"></app-dial>

            <app-dial class="dial dial-subspecialisms" v-model="value.subspecialisms" :filters="subspecialisms" :multi="true" name="subspecialisms"></app-dial>

            <app-dial class="dial dial-types" v-model="value.types" :filters="types" :multi="true"  name="types"></app-dial>

            <div class="dial dial-loading">
                <div class="app-dial-circle">
                    <ul class="app-dial-ruler">
                        <li v-for="(tmp, key_main) in loading_dashes.main" :key="key_main">
                            <span>
                                <i v-for="(tmp, key_sub) in loading_dashes.sub" :key="key_sub"></i>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="dial dial-submit">
                <div class="app-dial-circle"></div>
            </div>
        </div>

        <div class="app-filter-submit">
            <button type="submit" :disabled="loading" @click="submit">
                <div class="results">
                    <span>{{ results }}</span>
                    <s>Results</s>
                </div>
            </button>
        </div>

        <app-board class="board-levels" v-model="value.levels" :filters="filters.levels" name="levels"></app-board>
    </div>
</template>

<script>
import appDial from './app-dial.vue'
import appBoard from './app-board.vue'

export default {
    props: {
        value: {
            type: Object,
            default: () =>  {
                return {
                    area: 1,
                    specialisms: [0],
                    subspecialisms: [0],

                    types: [1],
                    
                    levels: [1],
                }
            },
        },
        filters: {
            type: Object,
            required: true,
        },
        results: {
            type: Number,
            required: false,
            default: 0,
        },
        loading: {
            type: Boolean,
            required: false,
            default: false,
        },
    },

    components: {
        appDial,
        appBoard,
    },

    data() {
        return {
            dashes: {
                main: 8,
                sub: 2,
            },
        }
    },
    
    methods: {
        submit() {
            this.$emit('submit', this.value)
        },
    },

    computed: {
        areas() {
            let areas = [...this.filters.areas]

            const filter_all_index = areas.findIndex(area => area.id === 0)
            if (filter_all_index != -1) {
                const filter_all = areas.splice(filter_all_index, 1)

                areas.unshift(filter_all[0])
            }

            return areas
        },

        specialisms() {
            let specialisms = this.filters.specialisms.filter(spec => spec.id === 0 || spec.area_id == this.value.area)

            const filter_all_index = specialisms.findIndex(spec => spec.id === 0)
            if (filter_all_index != -1) {
                const filter_all = specialisms.splice(filter_all_index, 1)

                specialisms.unshift(filter_all[0])
            }

            return specialisms
        },

        subspecialisms() {
            let subspecialisms = []

            let specialisms = {}
            this.value.specialisms.forEach(spec_id => specialisms[spec_id] = true)

            if (specialisms[0]) {
                let area_specialisms = {}
                this.specialisms.forEach(spec => area_specialisms[spec.id] = true)

                subspecialisms = this.filters.subspecialisms.filter(sub => sub.id === 0 || sub.specialism_id in area_specialisms)
            } else {
                this.filters.subspecialisms.forEach(sub => {
                    if (sub.id === 0 || sub.specialism_id in specialisms) {
                        subspecialisms.push(sub)
                    }
                })
            }

            const filter_all_index = subspecialisms.findIndex(spec => spec.id === 0)
            if (filter_all_index != -1) {
                const filter_all = subspecialisms.splice(filter_all_index, 1)

                subspecialisms.unshift(filter_all[0])
            }

            return subspecialisms
        },

        types() {
            let types = [...this.filters.types]
            
            const filter_all_index = types.findIndex(type => type.id === 0)
            if (filter_all_index != -1) {
                const filter_all = types.splice(filter_all_index, 1)
                
                types.unshift(filter_all[0])                
            }          

            return types
        },

        loading_dashes() {
            let dashes = {}

            for (let key in this.dashes) {
                dashes[key] = new Array(this.dashes[key])
            }

            return dashes
        },
    },

    watch: {
        value: {
            handler() {
                this.$emit('change', this.value)
            },
            deep: true,
        },
    },
}
</script>

<style lang="scss">
$WIDTH: 1150px;

$perspective: 380px;
$rotateX: 30.3deg;

.app-filter {
    width: $WIDTH;
    height: 840px;
    position: relative;

    overflow: hidden;
    flex-shrink: 0;

    * {
        backface-visibility: hidden;
    }

    .app-filter-bg {
        width: $WIDTH;
        height: 100%;
        position: relative;

        .dials {
            height: 88%;
            background: url(./img/dial-clean.png) no-repeat center;
            background-size: contain;
            position: relative;
            z-index: 1;
        }

        .levels {
            width: 70%;
            height: 40%;
            background: url(./img/dial-shelf0.png) no-repeat center;
            background-size: contain;
            position: absolute;
            left: 15%;
            bottom: -54px;
            z-index: 0;
        }
    }

    &>.app-filter-dials {
        $width: $WIDTH;
        
        width: $width;
        height: 88%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;

        .dial {
            $R: $width * 1.85;

            $R_areas: 1;
            $R_specialisms: .86;
            $R_subspecialisms: .83;
            $R_types: .77;
            $R_submit: .74;

            perspective: $perspective;

            $perspective_origin: .5;
            $perspective_origin: 0;

            border-radius: 0;
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            .app-dial-circle {
                border-radius: 50%;
            }

            .app-dial-circle {
                transform: rotateX($rotateX) translate3d(-50%, #{-$R * .347}, #{-$R * .1});
            }

            &.dial-areas {
                $r: $R * $R_areas;
                $li: ($r - ($r * $R_specialisms)) / 2;
                
                width: 0;
                height: $r;

                .app-dial-circle {
                    width: $r;
                    height: $r;

                    li {
                        span {
                            height: $li;

                            $transform_Y: -(($r / 2) - $li);
                            transform-origin: 50% $transform_Y 0;
                        }
                    }
                }
            }

            &.dial-specialisms {
                $r: $R * $R_areas * $R_specialisms;
                $li: ($r - ($r * $R_subspecialisms)) / 2;

                width: 0;
                height: $r;

                .app-dial-circle {
                    width: $r;
                    height: $r;

                    li {
                        span {
                            height: $li;

                            $transform_Y: -(($r / 2) - $li);
                            transform-origin: 50% $transform_Y 0;
                        }
                    }
                }
            }

            &.dial-subspecialisms,
            &.dial-loading {
                $r: $R * $R_areas * $R_specialisms * $R_subspecialisms;
                $li: ($r - ($r * $R_types)) / 2;
                
                width: 0;
                height: $r;

                .app-dial-circle {
                    width: $r;
                    height: $r;

                    li {
                        span {
                            height: $li;

                            $transform_Y: -(($r / 2) - $li);
                            transform-origin: 50% $transform_Y 0;
                        }
                    }
                }
            }

            &.dial-types {
                $r: $R * $R_areas * $R_specialisms * $R_subspecialisms * $R_types;
                $li: ($r - ($r * $R_submit)) / 2;
                
                width: 0;
                height: $r;

                .app-dial-circle {
                    width: $r;
                    height: $r;

                    li {
                        span {
                            height: $li;

                            $transform_Y: -(($r / 2) - $li);
                            transform-origin: 50% $transform_Y 0;
                        }
                    }
                }
            }

            &.dial-submit {
                $r: $R * $R_areas * $R_specialisms * $R_subspecialisms * $R_types * $R_submit;
                $li: ($r - ($r * $R_submit)) / 2;
                
                width: 0;
                height: $r;

                .app-dial-circle {
                    width: $r;
                    height: $r;

                    li {
                        span {
                            height: $li;

                            $transform_Y: -(($r / 2) - $li);
                            transform-origin: 50% $transform_Y 0;
                        }
                    }
                }
            }

            &.dial-loading {
                display: none;

                .app-dial-circle {
                    box-shadow: none;

                    .app-dial-ruler {
                        display: block;
                        width: 100%;
                        height: 100%;
                        margin: 0;
                        padding: 0;
                        list-style: none;
                        user-select: none;
                        border-radius: 50%;

                        opacity: 0;
                        transition: opacity .3s;

                        @keyframes rotation {
                            0% {
                                transform: rotateZ(0deg);
                            }
                            100% {
                                transform: rotateZ(360deg);
                            }
                        }

                        animation: 4s linear infinite rotation;
                    }

                    li {
                        position: absolute;
                        bottom: 0;
                        left: 50%;
                        transform: translateX(-50%);

                        span {
                            position: relative;
                            display: block;

                            width: 0;

                            &:after,
                            i:after {
                                content: "";
                                display: block;
                                width: 3px;
                                height: 120%;
                                position: absolute;
                                bottom: -10%;
                                left: 50%;
                                transform: translateX(-50deg);
                                background: transparentize(#000, .25);
                            }

                            i {
                                display: inline-block;
                                width: 0;
                                height: 100%;
                                position: absolute;
                                bottom: 0;
                                left: 0;
                                font-style: normal;

                                transform-origin: inherit;

                                &:after {
                                    width: 2px;
                                    height: 50%;
                                }
                            }
                        }

                        $count-rules: 8;
                        $count-subrules: 2;

                        $angle-rule: 360deg / $count-rules;
                        $angle-subrule: $angle-rule / ($count-subrules + 1);

                        @for $n from 1 through $count-rules {
                            $deg: $angle-rule * ($n - 1);

                            &:nth-child(#{$n}) span {
                                transform: rotateZ(#{$deg});
                            }
                        }

                        span i {
                            @for $i from 1 through $count-subrules {
                                $deg: $angle-subrule * $i;

                                &:nth-child(#{$i}) {
                                    transform: rotateZ(#{$deg});
                                }
                            }
                        }
                    }
                }
            }

            .app-dial-circle {
                box-shadow: inset 0 0 2px 4px rgba(0,0,0,.5), 0 0 3px 4px rgba(255,255,255,.5);
            }

            &:first-child {
                .app-dial-circle {
                    box-shadow: none;
                }
            }
        }

        .dial-testing {
            .app-dial-circle {
                li {
                    @for $n from 1 through 36 {
                        &:nth-child(#{$n}) span {
                            transform: rotateZ(#{-(360 / 36) * ($n - 1)}deg);

                            &:before {
                                content: "#{$n}";
                            }
                        }
                    }
                }
            }
        }
    }

    .board-levels {
        position: absolute;
        left: 50%;
        bottom: 45px;
        transform: translateX(-50%);
    }

    .app-filter-submit {
        position: absolute;
        top: 36px;
        left: 50%;
        transform: translateX(-50%);
        background: url(./img/dial-button-on-up.png) no-repeat center;
        background-size: contain;
        width: 310px;
        height: 230px;
        z-index: 10;
        border-radius: 50%;
        user-select: none;

        button {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            margin: 0;
            border-radius: 50%;
            background: transparent no-repeat center;
            background-size: contain;
            user-select: none;

            perspective: $perspective;

            cursor: pointer;

            &:active {
                background-image: url(./img/dial-button-on-down.png);

                .results {
                    top: 55%;
                }
            }
        }

        .results {
            $R: 200px;

            font-weight: bold;
            color: white;
            text-shadow: 0 0.1em 0.25em #000;

            width: $R;
            height: $R;

            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            
            transform: translate3d(-50%, -70%, -15px) rotateX($rotateX);

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            &>* {
                display: block;
                text-decoration: none;
                padding: 5px 0;
            }

            span {
                font-size: 38px;
                flex-shrink: 0;
            }

            s {
                font-size: 22px;
            }
        }
    }

    &.app-filter-loading {
        &>.app-filter-dials {
            .dial {
                pointer-events: none;

                &.dial-loading {
                    display: block;

                    .app-dial-circle {
                        box-shadow: none;

                        .app-dial-ruler {
                            opacity: 1;
                        }
                    }
                }
            }
        }

        .board-levels {
            pointer-events: none;
        }

        .app-filter-submit {
            background-image: url(./img/dial-button-on-down.png);

            button {
                pointer-events: none;
            }

            .results {
                display: none;
            }
        }
    }
}
</style>
