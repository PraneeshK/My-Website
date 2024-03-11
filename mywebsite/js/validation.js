const validation = new JustValidate("#signup");
//Makes name field required.
validation
    .addField("#name", [
        {
            rule: "required"
        }
    ])
//Makes email field required. Also ensures the format is correct
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                       .then(function(response) {
                           return response.json();
                       })
                       .then(function(json) {
                           return json.available;
                       });
            },
            errorMessage: "email already taken"
        }
    ])
    //Makes password required. Makes sure it has 8 characters 1 letter and 1 special character.
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    //Makes sure passwords match
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });   
    
    
    