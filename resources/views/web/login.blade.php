<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Log In</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formLogin" method="POST" action="{{ route('login')}} ">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Usuario:</label>
                        <input type="text" class="form-control" id="recipientUser" name="recipientEmail">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Contraseña:</label>
                        <input class="form-control" id="recipientPass" name="recipientPass">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="clickLogIn()">Acceder</button>
            </div>
        </div>
    </div>
</div>

<script>
    function clickLogIn(){
        console.log("Start Login")
        var form = document.getElementById('formLogin')
        var user = document.getElementById("recipientUser").value
        var pass = document.getElementById("recipientPass").value

        if(user == "" || pass == ""){
            return
        }

        user = user.trim().toLowerCase()
        pass = pass.trim().toLowerCase()

        console.log(user + " " + pass)
        form.submit()
    }
</script>
