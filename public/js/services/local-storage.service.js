function LocalStorageService() {

    let _data = localStorage.getItem("storage");
    if(_data) {
        _data = JSON.parse(data);
    } else {
        _data = {};
    }
    const _store = new rxjs.BehaviorSubject(_data);
    this.store$ = _store.asObservable();
}

LocalStorageService.prototype.store = function (data) {
    this._data = data;
    this._store.next(data);
    localStorage.setItem(
        "storage",
        JSON.stringify(_data)
    )
}