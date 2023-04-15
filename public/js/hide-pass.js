/*=============== SHOW HIDDEN - PASSWORD ===============*/
window.onload = () => {
const showHiddenPass = (inputPassword, InputIcon) =>{
    const input = document.getElementById(inputPassword),
        iconEye = document.getElementById(InputIcon)


    iconEye.addEventListener('click', ()=>{
        //Change password to text
        if(input.type === 'password'){
            //Switch to text
            input.type = 'text'

            //Add icon
            iconEye.classList.add('ri-eye-fill')

            //Remove
            iconEye.classList.remove('ri-eye-off-fill')
        }else{
            //Change to password
            input.type = 'password'

            //Remove icon
            iconEye.classList.remove('ri-eye-fill')
            // Add icon
            iconEye.classList.add('ri-eye-off-fill')
        }
    })
}


showHiddenPass('inputPassword', 'input-icon')};

