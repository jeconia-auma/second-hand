const body = document.querySelector('body');
const dated = document.querySelector('#date');
const timed = new Date();
const years = timed.getFullYear();

function times() {
    dated.innerHTML = "&copy; copyright " + years + " Jeck's Tech World";    
}