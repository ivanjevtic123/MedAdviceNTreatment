<!--Filip Kojic 0285/2018 -->
<div class="col-lg-8 col-md-8 right">
			<form name="ocenaform" action="<?= site_url("Pacijent/oceni") ?>">
            <table class="table table-striped">
                <th>Ime i prezime</th>
                <th>Broj dozvoljenih ocenjivanja</th>
                <th>Ocena</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <tr>
                    <td>Filip Kojic</td>
                    <td>2</td>
                    <td>
                        <input type="text" name = "ocena" id = "ocena" placeholder="Ocena...">
                    </td>
                    <td> <button class="btn btn-secondary">Oceni</button>  </td>
                </tr>
                <tr>
                    <td>Ivan Jevtic</td>
                    <td>0</td>
                    <td>
                        <input type="text" placeholder="Ocena...">
                    </td>
                    <td> <button class="btn btn-secondary">Oceni</button>  </td>
                </tr>
            </table>
            </form>


            </div>
        </div>