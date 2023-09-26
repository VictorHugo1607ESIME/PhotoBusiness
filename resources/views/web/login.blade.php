<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        @livewire('login')
    </div>
</div>

<script>
    function clickLogIn() {
        console.log("Start Login")
        var form = document.getElementById('formLogin')
        var user = document.getElementById("recipientUser").value
        var pass = document.getElementById("recipientPass").value

        if (user == "" || pass == "") {
            return
        }

        user = user.trim().toLowerCase()
        pass = pass.trim().toLowerCase()

        console.log(user + " " + pass)
        form.submit()
    }
</script>
