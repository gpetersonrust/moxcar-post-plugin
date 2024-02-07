import  '../scss/admin.scss';

function subscriber_cards_handler(){
    let subscriber_cards = document.querySelectorAll('.subscribers-card');
       subscriber_cards.forEach(subscribe_card_method);



       //  methods to handle subscriber cards
   
    function subscribe_card_method(subscriber_card)  {
        //  get subscriber-options
        let subscriber_options = subscriber_card.querySelector('.subscriber-options');
        let user_id = subscriber_card.getAttribute('id');
        // get subscriber-option-forms
        let subscriber_option_form_container = subscriber_card.querySelector('.subscriber-option-forms');
        let form = subscriber_option_form_container.querySelector('form');
        subscriber_form_handler(form, user_id);
       

        // get subscriber-options-toggle
        subscriber_options.addEventListener('click', function(){
            //  if style is none make option form flex else make it none
            console.log(subscriber_option_form_container);
            subscriber_option_form_container.style.display === 'none'  || !subscriber_option_form_container.style.display   ? subscriber_option_form_container.style.display = 'flex' : subscriber_option_form_container.style.display = 'none';
        }
        );
        }

        function subscriber_form_handler(form, user_id){
            let delete_checkbox = form.querySelector('#delete_user');
            let action = 'update'; 
            let button = form.querySelector('button');
            delete_checkbox.addEventListener('change', function(){
                if(delete_checkbox.checked){
                    action = 'delete';
                    button.textContent = 'Delete User';
                    // add class to button .delete-user-button 
                    button.classList.add('delete-user-button');
                }
                else{
                    action = 'update';
                    button.textContent = 'Update User';
                    // remove class from button .delete-user-button

                    button.classList.remove('delete-user-button');
                }
                console.log(action);
            }
            );
            // formdata
            

          form.addEventListener('submit', async function(e){
           
            try {
                e.preventDefault();
                // if action is delete ask for confirmation
                if(action === 'delete'){
                    let confirmation = confirm('Are you sure you want to delete this user?');
                    if(!confirmation){
                        return;
                    }
                }
    
                
                // create an action input field for form
                let action_input = document.createElement('input');
                action_input.setAttribute('type', 'hidden');
                action_input.setAttribute('name', 'action');
                action_input.setAttribute('value', action);
                form.appendChild(action_input);
                // create an user_id input field for form
                let user_id_input = document.createElement('input');
                user_id_input.setAttribute('type', 'hidden');
                user_id_input.setAttribute('name', 'user_id');
                user_id_input.setAttribute('value', user_id);
                form.appendChild(user_id_input);
                // now submit the form
                form.submit();
                
            } catch (error) {
                console.log(error);
                return alert('An error occured please try again later');
                
            }


          });
        }


}

subscriber_cards_handler();

// moxcar-pill

let moxcar_pills = document.querySelectorAll('.moxcar-pill');

moxcar_pills.forEach(moxcar_pill_handler);

function moxcar_pill_handler(moxcar_pill){
    moxcar_pill.addEventListener('click',  async function(){
     try {
        moxcar_pill.classList.toggle('active');
        //  data-post_url="<?php echo $post_url ?>" data-action="testing_mode" value="0" 
        let post_url = moxcar_pill.getAttribute('data-post_url');
        let action = moxcar_pill.getAttribute('data-action');
        let value = moxcar_pill.getAttribute('data-active');
        
        let new_value = value === '0' ? '1' : '0';
       console.log({
              post_url,
              action,
              value,
              new_value
         

       });

    //    reload the page with the action and new_value as query string
    let url = new URL(post_url);
    url.searchParams.set('action', action);
    url.searchParams.set('value', new_value);
    window
    .location
    .replace(url);


         

        
     } catch (error) {
        console.log(error);
        return alert('An error occured please try again later');
        
     }

    });
}
