<section class="filter p-4">
    <form class="row">
        <div class="col-12 col-md-3">
            <select class="form-element">
                <option value="1">Mercedes</option>
                <option value="2">BWM</option>
            </select>
        </div>
        <div class="col-12 col-md-3">
            <select class="form-element">
                <option value="1">Mercedes</option>
                <option value="2">BWM</option>
            </select>
        </div>
        <div class="col-12 col-md-3">
            <div class="d-flex checkboxes">
                <input type="radio" name="type" value="1" id="all" />
                <label for="all" class="form-element"> Hamsı </label>
                <input type="radio" name="type" value="2" id="new" />
                <label for="new" class="form-element"> Yeni </label>
                <input type="radio" name="type" value="3" id="secondary" />
                <label for="secondary" class="form-element"> Sürülmüş </label>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <select class="form-element">
                <option value="1">Mercedes</option>
                <option value="2">BWM</option>
            </select>
        </div>
        <div class="col-12 col-md-3">
            <div class="filterFlexDes">
                <div class="filterFlexDes50">
                    <input type="number" class="form-element" placeholder="Qiymet, min." />
                </div>
                <div class="filterFlexDes50">
                    <input type="number" class="form-element" placeholder="maks" />
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="filterFlexDes">
                <div class="filterFlexDes33">
                    <select class="form-element">
                        <option value="1">AZN</option>
                        <option value="2">USD</option>
                    </select>
                </div>
                <div class="filterFlexDes33">
                    <input type="checkbox" name="autoloan" value="autoloan" id="autoloan" />
                    <label for="autoloan" class="form-element"> Kredit </label>
                </div>
                <div class="filterFlexDes33">
                    <input type="checkbox" name="autobarter" value="autobarter" id="autobarter" />
                    <label for="autobarter" class="form-element"> Barter </label>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <select class="form-element">
                <option value="0">Ban novu</option>
                <option value="1">Mercedes</option>
                <option value="2">BWM</option>
            </select>
        </div>

        <div class="col-12 col-md-3">
            <div class="filterFlexDes">
                <div class="filterFlexDes50">
                    <select class="form-element" placeholder="bos">
                        <option value="0">Il, min</option>
                        <option value="1">Mercedes</option>
                        <option value="2">BWM</option>
                    </select>
                </div>
                <div class="filterFlexDes50">
                    <select class="form-element">
                        <option value="0">maks</option>
                        <option value="1">Mercedes</option>
                        <option value="2">BWM</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-danger">Axtar</button>
        </div>
    </form>
</section>
