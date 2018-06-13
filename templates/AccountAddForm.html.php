{extends file="templates/globalTemplate.html.php"}
{block name="body"}

<div class = "col-lg-12 col-md-12">
    <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6">

        <form action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Accounts&action=add" id="formularz" method="post">
            <legend class="text-center text-info" style="margin-top: 15px">Dodaj hasło</legend>


            <div class="form-group">
                <label for="Login" style="margin-top: -7px">Wybór Serwisu Internetowego</label>
                {html_options class="form-control" name="IdAccountDictionary" options=$listAccount}
            </div>

            <div class="form-group">
                <label for="Login"style="margin-top: -7px">Login</label>
                <input type="text" class="form-control" name="Login" id="Login"  placeholder="Podaj Login Do Serwisu" required="required"/>
            </div>

            <div class="form-group">
                <label for="Password"style="margin-top: -7px">Hasło</label>
                <input type="text" class="form-control" name="Password" id="Password" placeholder="Podaj Hasło Do Serwisu" required="required"/>
            </div>
			
			<input type="hidden" name="userId" value="{$smarty.session.idUser}"/>
			
            <button type="submit" class="btn btn-success">Dodaj</button>
        </form>
    </div>
</div>
{/block}