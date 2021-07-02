class Tab {
    constructor() {
        this.tabs = document.querySelectorAll('[data-tab]')
        this.arrayTabs = Array.from(this.tabs)
        this.tabsNames = this.arrayTabs.map(list => list.getAttribute('data-tab'))
        if(this.isHasDuplicates()){
            throw new Error('Tabs "names" have duplicates\n\rPlease change them')
        }
        this.activeClass = 'active'

        this.start()
    }
    isHasDuplicates(){
        return this.tabsNames.length !== [...new Set(this.tabsNames)].length
    }
    start(){
        this.tabsNames.forEach(name => {
            const place = document.querySelector(`[data-tab="${name}"]`)
            const triggers = place.querySelectorAll('[data-tab-trigger]')
            const contents = place.querySelectorAll('[data-tab-content]')
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