let tabs = document.querySelectorAll('.navigation-bar div')
let sections = document.querySelectorAll('.section')

let removeAllActive = ()=>{
    tabs.forEach(tab => {
        tab.classList.remove('active')
    });
    sections.forEach(section => {
        section.classList.remove('active')
    });
}

// let addActive = (tab)=>{
//     tab.classList.add('active')
//     console.log('before',document.querySelector('#section-'+tab.id));
//     document.querySelector('#section-'+tab.id).classList.add('active')
//     console.log('after', document.querySelector('#section-'+tab.id));
// }
    


tabs.forEach(tab1 => {
    tab1.addEventListener('click', ()=>{
        // removing all active classes
        tabs.forEach(tab => {
            tab.classList.remove('active')
        });
        sections.forEach(section => {
            section.classList.remove('active')
        });

        // add active class to clicked tab with its section
        tab1.classList.add('active')
        // console.log('before',document.querySelector('#section-'+tab.id));
        document.querySelector('#section-'+tab1.id).classList.add('active')
        // console.log('after', document.querySelector('#section-'+tab.id));
    })
});

console.log(tabs);