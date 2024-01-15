const delBtns = document.querySelectorAll('.del-btn')
const modal = document.querySelector('#modal-container')
const closeBtn = document.querySelector('#close-btn')
const idInput = document.querySelector('#recipe_id')
console.log(delBtns)
delBtns.forEach((btn) => {
    btn.addEventListener('click', (e) => {
        modal.style.display = 'flex'
        idInput.value = e.target.dataset.id
        closeBtn.onclick = () => (modal.style.display = 'none')
        window.onclick = (e) => {
            if (e.target == modal) {
                modal.style.display = 'none'
            }
        }
    })
})
