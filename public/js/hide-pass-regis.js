
window.onload = () => {
    const showPass = (registration_form_plainPassword, InputIcon) =>{
        const inputs = document.getElementById(registration_form_plainPassword),
            iconEye = document.getElementById(InputIcon)


        iconEye.addEventListener('click', ()=>{
            //Change password to text
            if(inputs.type === 'password'){
                //Switch to text
                inputs.type = 'text'

                //Add icon
                iconEye.classList.add('ri-eye-fill')

                //Remove
                iconEye.classList.remove('ri-eye-off-fill')
            }else{
                //Change to password
                inputs.type = 'password'

                //Remove icon
                iconEye.classList.remove('ri-eye-fill')
                // Add icon
                iconEye.classList.add('ri-eye-off-fill')
            }
        })
    }


    showPass('registration_form_plainPassword', 'input-icon')}