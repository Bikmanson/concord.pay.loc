class Accordion {
    constructor() {
        this.accordions = document.querySelectorAll('[data-accordion]')
        this.arrayAccordions = Array.from(this.accordions)
        this.accordionNames = this.arrayAccordions.map(list => list.getAttribute('data-accordion'))
        if(this.isHasDuplicates()){
            throw new Error('Accordions "names" have duplicates\n\rPlease change them')
        }
        this.activeClass = 'active'

        this.start()
    }

    isHasDuplicates(){
        return this.accordionNames.length !== [...new Set(this.accordionNames)].length
    }

    start(){
        this.accordionNames.forEach(name => {
            const place = document.querySelector(`[data-accordion="${name}"]`)
            const triggers = place.querySelectorAll('[data-accordion-trigger]')
            const contents = place.querySelectorAll('[data-accordion-content]')
            if(triggers.length !== contents.length) {
                throw new Error('Number of triggers not equal to number of content blocks')
            }
            this.setListener({
                triggers,
                contents
            })
        })
    }

    setListener({triggers, contents}){
        triggers.forEach((trigger, triggerIndex) => {
            trigger.addEventListener('click', e => {
                this.handler({
                    triggers,
                    contents,
                    index: triggerIndex
                })
            })
        })
    }

    handler({triggers, contents, index}){
        triggers.forEach((trigger, triggerIndex) => {
            if(triggerIndex === index) {
                if(!!trigger.classList.value.match(new RegExp(this.activeClass))){
                    this.removeClass(trigger)
                    this.removeClass(contents[triggerIndex])
                }else{
                    this.addClass(trigger)
                    this.addClass(contents[triggerIndex])
                }
            }else{
                this.removeClass(trigger)
                this.removeClass(contents[triggerIndex])
            }
        })
    }

    addClass(el){
        el.classList.add(this.activeClass)
    }

    removeClass(el){
        el.classList.remove(this.activeClass)
    }
}