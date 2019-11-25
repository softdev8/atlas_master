<template>
    <div class="app-dial" :class="{'app-dial-multi': multi}">
        <div class="app-dial-circle" @mousedown="mousedown" v-touch:start="mousedown">
            <ul class="app-dial-options">
                <template v-if="multi">
                    <li v-for="(val, key) in options.list" :key="key" :class="{top: options.top == key}">
                        <span v-if="val.title" :style="rotateForPosition[key]">
                            <input type="checkbox" :id="name + val.id" :value="val.id" v-model="selected.value" @change="changeValues(val.id)">
                            <label :for="name + val.id">{{ val.title }}</label>
                        </span>
                    </li>
                </template>
                <template v-else>
                    <li v-for="(val, key) in options.list" :key="key" :class="{'app-dial-selected': value == val.id, 'app-dial-top': options.top == key}">
                        <span v-if="val.title" :style="rotateForPosition[key]">
                            <s>{{ val.title }}</s>
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: [Number, Array],
            default: null,
        },
        filters: {
            type: Array,
            required: true,
        },
        multi: {
            type: Boolean,
            default: false,
        },
        name: {
            type: String,
            required: true,
            default: () => Math.floor(Math.random() * 1000000).toString(),
        },
    },

    data() {
        return {
            selected: {
                value: null,
                index: null,
            },

            options: {
                limit: 12,

                list: [],

                top: null,
                infinity: false,
            },

            rotation: {
                active: false,

                start: {
                    x: null,
                    y: null,
                    deg: null,
                },

                end: {
                    deg: null,
                },
                
                angle: {
                    min: null,
                    max: null,
                    option: null,
                },
            },

            speed: .1,

            transition: 200,

            self: false,

            dial: {
                $el: null,
                center: {
                    x: null,
                    y: null,
                },
            },
        }
    },

    created() {       
        this.init()
    },

    methods: {
        init() {
            this.options.infinity = this.filters.length > this.options.limit

            this.rotation.angle.option = Math.round(360 / this.options.limit)
            this.rotation.angle.limit = this.filters.length * this.rotation.angle.option

            this.initValue(true)

            this.$nextTick(() => {
                this.dial.$el = this.$el.querySelector('.app-dial-options')

                const position_deg = this.selected.index * this.rotation.angle.option

                this.tuning(position_deg, this.transition)
            })
        },

        initValue(created) {
            if (this.multi) {
                if (this.value === null) {
                    this.selected.index = null
                } else {
                    this.selected.index = this.filters.findIndex(filter => {
                        let found = this.value.find(val => {
                            let equal = val == filter.id
                            
                            return equal
                        })

                        return found !== undefined
                    })
                 
                    if (this.selected.index == -1) {
                        this.selected.index = null
                    }
                }

                if (this.selected.index === null) {
                    const index_all = this.filters.findIndex(filter => filter.id === 0)

                    this.selected.index = index_all == -1 ? 0 : index_all

                    this.changeValues(this.filters[ this.selected.index ].id)
                } else {
                    this.selected.value = []

                    this.value.forEach(value => {
                        const index = this.filters.findIndex(filter => filter.id == value)

                        if (index != -1) {
                            this.selected.value.push(value)
                        }
                    })

                    if (this.selected.value.length != this.value.length) {
                        this.changeValues()
                    }
                }
            } else {
                if (this.value === null) {
                    this.selected.index = null
                } else {
                    this.selected.index = this.filters.findIndex(val => val.id == this.value)

                    if (this.selected.index == -1) {
                        this.selected.index = null
                    }
                }

                if (this.selected.index === null) {
                    this.selected.index = 0
                    this.emit(this.filters[0].id)
                }

                this.selected.value = this.filters[this.selected.value]
            }

            this.options.list = []

            if (this.options.infinity) {
                this.rotation.angle.min = null
                this.rotation.angle.max = null

                this.options.top = Math.round((this.options.limit) / 2)

                for (let n = this.selected.index; n < this.options.top + this.selected.index && n < this.filters.length; n++) {
                    this.options.list.push( {...this.filters[n], ...{index: n}} )
                }

                for (let n = 0; n < this.options.top - (this.filters.length - this.selected.index); n++) {
                    this.options.list.push( {...this.filters[n], ...{index: n}} )
                }

                if (this.options.top - this.selected.index > 0) {
                    for (let n = this.filters.length - (this.options.top - this.selected.index); n < this.filters.length; n++) {
                        this.options.list.push( {...this.filters[n], ...{index: n}} )
                    }

                    for (let n = 0; n < this.selected.index; n++) {
                        this.options.list.push( {...this.filters[n], ...{index: n}} )
                    }
                } else {
                    for (let n = this.selected.index - this.options.top; n < this.selected.index; n++) {
                        this.options.list.push( {...this.filters[n], ...{index: n}} )
                    }
                }

                this.selected.index = 0
            } else {
                for (let n = 0; n < this.filters.length; n++) {
                    this.options.list.push( {...this.filters[n], ...{index: n}} )
                }
                
                if (this.filters.length == this.options.limit) {
                    this.rotation.angle.min = null
                    this.rotation.angle.max = null
                } else {
                    this.rotation.angle.min = 0
                    this.rotation.angle.max = (this.filters.length - 1) * this.rotation.angle.option

                    const empty = { title: null }
                    for (let n = this.filters.length; n < this.options.limit; n++) {
                        this.options.list.push( {...{id: 'empty-' + n}, ...this.filters[n]} )
                    }
                }
            }

            if (!created) {
                const position_deg = this.selected.index * this.rotation.angle.option
                
                this.tuning(position_deg, this.transition)
            }
        },



        setSelectedIndex(position) {
            this.selected.index = position < 0
                                ? this.options.limit + position
                                : (position >= this.options.limit ? position % this.options.limit : position)

            if (!this.multi) {
                const value = this.options.list[ this.selected.index ] && this.options.list[ this.selected.index ].id || undefined
                
                this.emit(value)
            }
        },

        changeValues(value) { 
            if (value !== null && value !== undefined) {
                if (this.selected.value === null) {
                    this.selected.value = [value]
                }
                else
                if (!this.selected.value.length) {
                    this.selected.value = [0]
                } else {
                    if (value) {
                        const index_all = this.selected.value.findIndex(val => val === 0)

                        if (index_all != -1) {
                            this.selected.value.splice(index_all, 1)
                        }
                    } else {
                        this.selected.value = [0]
                    }
                }
            }

            this.emit(this.selected.value)
        },



        emit(value) {
            this.self = true

            this.$emit('input', value)
            this.$emit('change', value)
        },



        mousedown(event) {
            //console.group('mousedown(event) {')
            //console.log('event', event)

            event.stopPropagation()
            event.preventDefault()

            if (!this.rotation.active) {
                const rect = this.$el.querySelector('.app-dial-circle').getBoundingClientRect()

                this.dial.center = {
                    x: rect.left + (rect.width * .5),
                    y: rect.top + (rect.height * .4),
                }

                this.rotation.active = true

                if ('touches' in event && event.touches.length) {
                    this.rotation.start.x = event.touches[0].clientX
                    this.rotation.start.y = event.touches[0].clientY
                } else {
                    this.rotation.start.x = event.clientX
                    this.rotation.start.y = event.clientY
                }

                this.rotation.start.deg = this.selected.index * this.rotation.angle.option

                //console.log('this.rotation', this.rotation)

                document.addEventListener('mousemove', this.mousemove, { passive: false })
                document.addEventListener('mouseup', this.mouseup, { passive: false })
                
                document.addEventListener('touchmove', this.mousemove, { passive: false })
                document.addEventListener('touchend', this.mouseup, { passive: false })
                document.addEventListener('touchcancel', this.mouseup, { passive: false })
            }
            //console.groupEnd()
        },



        mouseup() {
            //console.group('mouseup() {')
            document.removeEventListener('touchcancel', this.mouseup)
            document.removeEventListener('touchend', this.mouseup)
            document.removeEventListener('touchmove', this.mousemove)

            document.removeEventListener('mouseup', this.mouseup)
            document.removeEventListener('mousemove', this.mousemove)

            const position = Math.round(this.rotation.end.deg / this.rotation.angle.option)

            const position_deg = position * this.rotation.angle.option

            this.tuning(position_deg, this.transition, () => {
                this.setSelectedIndex(position)

                this.rotation.active = false
            })
            //console.groupEnd()
        },



        mousemove(event) {
            //console.group('mousemove(event) {')
            //console.log('event', event)

            event.stopPropagation()
            event.preventDefault()

            let clientX = null
            let clientY = null

            if ('touches' in event && event.touches.length) {
                clientX = event.touches[0].clientX
                clientY = event.touches[0].clientY
            } else {
                clientX = event.clientX
                clientY = event.clientY
            }

            const deg = (
                (clientY > this.dial.center.y ? 1 : -1) * (this.rotation.start.x - clientX)
                - (clientX > this.dial.center.x ? 1 : -1) * (this.rotation.start.y - clientY) * .5
            ) * this.speed

            let angle = this.rotation.start.deg + deg
            
            if (this.rotation.angle.min !== null && angle < this.rotation.angle.min) {
                angle = this.rotation.angle.min
            }
            else
            if (this.rotation.angle.max !== null && angle > this.rotation.angle.max) {
                angle = this.rotation.angle.max
            }

            this.rotation.end.deg = angle



            if (this.options.infinity) {
                let deg = this.rotation.end.deg % 360
                let position_deg = this.rotation.end.deg / this.rotation.angle.option
                let position = Math.round(position_deg)

                let top = (Math.round((this.options.limit) / 2) + position) % this.options.limit
                    top = top < 0
                        ? this.options.limit + top
                        : (top >= this.options.limit ? this.options.limit - top : top)
                        
                this.options.top = top



                const way = position < position_deg ? -1 : 1;

                let neighbour = top + way
                    neighbour = neighbour < 0
                                ? this.options.limit - 1
                                : (neighbour >= this.options.limit ? 0 : neighbour)

                if (this.options.list[ neighbour ] && 'index' in this.options.list[ neighbour ]) {
                    const neighbour_index = this.options.list[ neighbour ] && this.options.list[ neighbour ].index

                    let top_index = neighbour_index - way
                        top_index = top_index < 0
                                    ? this.filters.length - 1
                                    : (top_index >= this.filters.length ? 0 : top_index)

                    if (this.options.list[top].index != top_index) {
                        const diff = Math.abs(this.options.list[top].index - top_index)

                        this.options.list[top] = {...this.filters[top_index], ...{index: top_index}}
                    }
                }
            }

            this.dial.$el.style.transform = 'rotateZ(' + this.rotation.end.deg + 'deg)'
            this.tuning(this.rotation.end.deg, 0, () => {
                this.rotation.start.x = clientX
                this.rotation.start.y = clientY
                this.rotation.start.deg = angle
            })
            //console.groupEnd()

            return false
        },



        tuning(deg, duration, callback) {
            if (duration > 0) {
                this.$el.classList.add('tuning')
            }

            this.dial.$el.style.transform = 'rotateZ(' + deg + 'deg)'

            if (duration > 0) {
                setTimeout(() => {
                    this.$el.classList.remove('tuning')

                    if (typeof callback === 'function') {
                        callback()
                    }
                }, 200)
            } else {
                if (typeof callback === 'function') {
                    callback()
                }
            }
        },
    },

    computed: {
        rotateForPosition() {
            let rotate = []

            for (let pos = 0; pos < this.options.limit; pos++) {
                rotate.push({
                    transform: 'rotateZ(-' + pos * this.rotation.angle.option + 'deg)'
                })
            }

            return rotate
        },
    },



    watch: {
        value() {
            if (this.self) {
                this.self = false
            } else {
                this.initValue()
            }
        },

        filters() {
            this.init()
        },
    },
}
</script>

<style lang="scss">
$margin-top: 20px;
$checkbox-height: 30px;

.app-dial {
    border-radius: 0;

    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    &.tuning {
        .app-dial-circle {
            .app-dial-options {
                transition: transform .2s;
            }
        }
    }

    .app-dial-circle {
        // background: rgba(0,0,0,.2);
        width: 100%;
        height: 100%;
        border-radius: 50%;

        position: absolute;
        top: 0;
        left: 0;
        
        .app-dial-options {
            display: block;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            list-style: none;
            user-select: none;
            border-radius: 50%;
        }

        li {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            
            // @for $n from 1 through 12 {
            //     &:nth-child(#{$n}) span {
            //         transform: rotateZ(#{-(360 / 12) * ($n - 1)}deg);

            //         &:before {
            //             content: "#{$n - 1}";
            //         }
            //     }
            // }

            &.app-dial-selected {
                color: #0081bc;
            }

            span {
                position: relative;
                display: block;
                height: 100%;
                
                s, label {
                    font-size: 22px;
                    font-weight: bold;
                    text-decoration: none;
                    text-align: center;
                    position: absolute;
                    top: $margin-top;
                    left: 50%;
                    width: 250px;
                    transform: translateX(-50%);
                    height: calc(100% - $margin-top);

                    i {
                        font-size: 16px;
                        display: block;
                        text-align: center;
                    }
                }

                label {
                    cursor: pointer;
                }

                input[type=checkbox] {
                    display: none;

                    &:checked {
                        &+label {
                            color: #3087b0;
                        }
                    }
                }
                
            }

            // &.top {
            //     span {
            //         s {
            //             background: red;
            //             color: white;
            //         }
            //     }
            // }
        }
    }

    // &.app-dial-multi {
    //     .app-dial-circle {
    //         li {
    //             span {
    //                 s {
    //                     top: #{$margin-top + $checkbox-height + 5};
    //                 }
    //             }
    //         }
    //     }
    // }

    .info {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 200px;
        min-height: 300px;
        // background: transparentize($color: white, $amount: .5);
        background: red;
        z-index: 1000;
    }

    &.app-dial-with-guides {
        &:before,
        &:after {
            content: "";
            display: block;
            position: absolute;
            min-width: 2px;
            min-height: 2px;
            background: black;
            z-index: 100;

            pointer-events: none;
        }
        &:before {
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
        }
        &:after {
            top: 0;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
        }
    }

    &.dial-specialisms {
        .app-dial-circle {
            li {
                span {
                    label {
                        font-size: 25px;
                    }
                }
            }
        }
    }

    &.dial-subspecialisms {
        .app-dial-circle {
            li {
                span {
                    label {
                        font-size: 25px;
                    }
                }
            }
        }
    }

    &.dial-types {
        .app-dial-circle {
            li {
                span {
                    label {
                        font-size: 28px;
                    }
                }
            }
        }
    }
}
</style>

