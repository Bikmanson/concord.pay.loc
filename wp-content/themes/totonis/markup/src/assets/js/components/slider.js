class Sliders {
    constructor() {
        this.sliders = document.querySelectorAll('[data-slider-list]')
        this.arraySliders = Array.from(this.sliders)
        this.slidersNames = this.arraySliders.map(list => list.getAttribute('data-slider-list'))
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
            const name = slider.getAttribute('data-slider-list')
            const arrowPrev = document.querySelector(`[data-slider-arrow-prev="${name}"]`)
            const arrowNext = document.querySelector(`[data-slider-arrow-next="${name}"]`)
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

            const options = {
                slidesToScroll: 1,
                slidesToShow: 1,
                dots: true,
                arrows: item.hasArrows,
                infinite: true,
                responsive: [],
                adaptiveHeight: true
            }

            if (item.hasArrows) {
                options.prevArrow = item.arrowPrev
                options.nextArrow = item.arrowNext
            }

            $list.on('init', e => {
                if (item.hasArrows) {
                    this.setPositionArrows({
                        arrowPrev: item.arrowPrev,
                        arrowNext: item.arrowNext,
                        firstChildren: $list.children().first()
                    })
                    window.addEventListener('resize', e => {
                        this.setPositionArrows({
                            arrowPrev: item.arrowPrev,
                            arrowNext: item.arrowNext,
                            firstChildren: $list.children().first()
                        })
                    })
                }
            })

            $list.slick(options)

            document.addEventListener('resize', e => {
                if (window.innerWidth >= 560) {
                    $list.slick('reinit');
                }
            })
        })
    }

    setPositionArrows({arrowPrev, arrowNext, firstChildren}) {
        const height = firstChildren.height()
        const positionTop = height / 2
        arrowPrev.style.top = `${positionTop}px`
        arrowNext.style.top = `${positionTop}px`
    }
}