<div class="container mt-3">
    <h1 class="display-3">Demo component Bootstrap</h1>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <?php
            Flasher::setFlash('Ini pesan alert default', 'primary');
            Flasher::showFlash();
            Flasher::setFlash('Ini pesan alert hijau', 'success');
            Flasher::showFlash();
            Flasher::setFlash('Ini pesan alert merah', 'danger');
            Flasher::showFlash();
            ?>
        </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <button class="btn btn-primary">Tombol</button>
            <button class="btn btn-secondary">Tombol</button>
            <button class="btn btn-success">Tombol</button>
            <button class="btn btn-warning">Tombol</button>
            <button class="btn btn-danger">Tombol</button>
            <button class="btn btn-dark">Tombol</button>
            <button class="btn btn-light">Tombol</button>
        </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <button class="btn btn-lg btn-primary">Tombol</button>
            <button class="btn btn-lg btn-outline-secondary">Tombol</button>
            <button class="btn btn-lg btn-outline-success">Tombol</button>
            <button class="btn btn-lg btn-outline-warning">Tombol</button>
            <button class="btn btn-danger">Tombol</button>
            <button class="btn btn-dark">Tombol</button>
            <button class="btn btn-light">Tombol</button>
        </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <button class="btn btn-outline-primary">Tombol</button>
            <button class="btn btn-outline-secondary">Tombol</button>
            <button class="btn btn-outline-success">Tombol</button>
            <button class="btn btn-outline-danger">Tombol</button>
            <button class="btn btn-outline-dark">Tombol</button>
            <button class="btn btn-outline-light">Tombol</button>
        </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">
            <button class="btn text-primary">Tombol</button>
            <button class="btn text-secondary">Tombol</button>
            <button class="btn text-success">Tombol</button>
            <button class="btn text-danger">Tombol</button>
            <button class="btn text-dark">Tombol</button>
            <button class="btn text-light">Tombol</button>
        </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Input text">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <input type="text" disabled class="form-control" placeholder="Input disabled">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <input type="date" class="form-control" placeholder="Input date">
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group">
                        <textarea class="form-control" rows="4" placeholder="Textarea"></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <div class="col-md">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check1">
                        <label class="custom-control-label" for="check1">Check this custom checkbox</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="check2">
                        <label class="custom-control-label" for="check2">Check this custom checkbox</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio1">Toggle this custom radio</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="customRadio2">Or toggle this other custom radio</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>