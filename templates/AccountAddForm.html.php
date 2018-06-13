{extends file="templates/globalTemplate.html.php"}
{block name="body"}

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Accounts&action=add" id="accountAdd" method="post">
            <legend class="text-center text-info" style="margin-top: 15px">Dodaj konto</legend>


            <div class="form-group">
                <label for="Login" style="margin-top: -7px">Wybór serwisu Internetowego</label>
                {html_options class="form-control" name="IdAccountDictionary" options=$listAccount}
            </div>

            <div class="form-group">
                <label for="Login"style="margin-top: -7px">Login</label>
                <input type="text" class="form-control" name="Login" id="Login"  placeholder="Podaj login do serwisu" required="required"/>
            </div>

            <div class="form-group">
                <label for="Password"style="margin-top: -7px">Hasło</label>
                <input type="text" class="form-control" name="Password" id="Password" placeholder="Podaj hasło do serwisu" required="required"/>
            </div>
            <input type="hidden" id="IP" name="IP" required="required" value="127.0.0.2"/>
			
			<input type="hidden" name="userId" value="{$smarty.session.idUser}"/>
			
            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
</div>
{/block}
{block name="js"}<script src="http://{$smarty.server.HTTP_HOST}{$subdir}resources/js/logForm.js"></script>{/block}