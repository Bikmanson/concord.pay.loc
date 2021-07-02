class GroupSlider {
    constructor() {
        this.sliders = document.querySelectorAll('[data-group-slider-list]')
        this.arraySliders = Array.from(this.sliders)
        this.slidersNames = this.arraySliders.map(list => list.getAttribute('data-group-slider-list'))
        if (this.isHasDuplicates()) {
            throw new Error('Sliders "names" have duplicates\n\rPlease change them')
        }

        this.slidersData = []

        this.setSlidersData()

        this.initSliders()
    }

    isHasDuplicates() {
        return this.slidersNames.length !== [...new Set(this.slidersNames)].length
    }

    setSlidersData() {
        this.arraySliders.forEach(slider => {
            const name = slider.getAttribute('data-group-slider-list')
            const arrowPrev = document.querySelector(`[data-group-slider-arrow-prev="${name}"]`)
            const arrowNext = document.querySelector(`[data-group-slider-arrow-next="${name}"]`)
            const hasArrows = !!arrowNext && !!arrowPrev

            const data = {
                name,
                hasArrows,
                arrowPrev,
                arrowNext,
                list: slider
            }
            this.slidersData.push(data)
        })
    }

    initSliders() {
        this.slidersData.forEach(item => {
            const $list = $(item.list)
            const slidesToShow = $list.attr('data-slide-to-show') ? parseInt($list.attr('data-slide-to-show')) : 3

            const options = {
                slidesToScroll: slidesToShow,
                slidesToShow,
                dots: true,
                arrows: item.hasArrows,
                infinite: false,
                responsive: [
                    {
                        breakpoint: 780,
                        settings: {
                            slidesToScroll: slidesToShow - 1,
                            slidesToShow: slidesToShow - 1,
                        }
                    }
                ],
                adaptiveHeight: true
            }

            if (item.hasArrows) {
                options.prevArrow = item.arrowPrev
                options.nextArrow = item.arrowNext
            }

            $list.slick(options)
        })
    }
}