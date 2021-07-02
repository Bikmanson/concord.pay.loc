class StickyHeader{
    constructor() {
        this.header = document.querySelector('.b-header')
        this.options = {
            startOffset: null
        }

        this.cssFixedClass = 'b-header_fixed'

        this.start()
    }
    start(){
        this.setOptions()
        this.listeners()
    }
    listeners(){
        window.addEventListener('scroll', e => {
            this.scrollHandler()
        })
        window.addEventListener('resize', e => {
           this.setOptions()
        })
    }
    setOptions(){
        this.options.startOffset = window.innerHeight / 2
    }
    scrollHandler(){
        const condition = window.scrollY >= this.options.startOffset
        this.setHeaderSticky(condition)
    }
    setHeaderSticky(condition){
        if(condition){
            this.header.classList.add(this.cssFixedClass)

            document.body.style.paddingTop = `${this.header.getBoundingClientRect().height}px`
        }else{
            this.header.classList.remove(this.cssFixedClass)

            document.body.style.paddingTop = ''
        }
    }
}