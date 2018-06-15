{extends file="templates/globalTemplate.html.php"}
{block name="body"}

<div class="panel-heading">
    <div class="panel-title text-center">
        <legend class="text-center text-info" style="margin-top: 15px">Zmiana danych</legend>
    </div>
    <form action="http://{$smarty.server.HTTP_HOST}{$subdir}?controller=Accounts&action=update" id="accountEdit" method="post" >
        <div class="main-login main-center" >
            <div class="form-group" >
                <div class="cols-sm-10">
                    <div class="form-group">
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="IdAccount" id="IdAccount" value="{$IdAccount}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="IdAccountDictionary" id="IdAccountDictionary" value="{$IdAccountDictionary}"/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group"  style="margin-top: -40px">
                        <label for="Login" class="cols-sm-2 control-label"">Login</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="Login" id="Login"  placeholder="Wprowadz nowy login" value="{$Login}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Password" class="cols-sm-2 control-label">Hasło</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="Password" id="Password" placeholder="Wprowadz nowe hasło" value="{$Password}"/>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="IP" name="IP" required="required" value="{$smarty.session.IPP}"/>
                    <input type="hidden" id="idUser" name="idUser" required="required" value="{$smarty.session.idUser}"/>
            <div class="form-group ">
                <button type="sumbit"  class="btn btn-success  login-button" style="width: 540px">Zapisz</button>
            </div>
        </div>
    </form>
</div>
{/block}