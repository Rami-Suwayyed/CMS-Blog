<div class="card-body">
    <form action="{{ route('admin.contact_us.index') }}" method="get">
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}" class="form-control" placeholder="{{ __('Backend/contact_us.search') }}">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="status" class="form-control">
                        <option value=""> --- </option>
                        <option value="1" {{ old('status', request('status')) == '1' ? 'selected' : '' }}>{{ __('Backend/contact_us.active') }}</option>
                        <option value="0" {{ old('status', request('status')) == '0' ? 'selected' : '' }}>{{ __('Backend/contact_us.inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="sort_by" class="form-control">
                        <option value=""> --- </option>
                        <option value="name" {{ old('sort_by', request('sort_by')) == 'name' ? 'selected' : '' }}>{{ __('Backend/contact_us.name') }}</option>
                        <option value="title" {{ old('sort_by', request('sort_by')) == 'title' ? 'selected' : '' }}>{{ __('Backend/contact_us.title') }}</option>
                        <option value="created_at" {{ old('sort_by', request('sort_by')) == 'created_at' ? 'selected' : '' }}>{{ __('Backend/contact_us.created_at') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <select name="order_by" class="form-control">
                        <option value=""> --- </option>
                        <option value="asc" {{ old('order_by', request('order_by')) == 'asc' ? 'selected' : '' }}>{{ __('Backend/contact_us.ascending') }}</option>
                        <option value="desc" {{ old('order_by', request('order_by')) == 'desc' ? 'selected' : '' }}>{{ __('Backend/contact_us.descending') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-1">
                <div class="form-group">
                    <select name="limit_by" class="form-control">
                        <option value=""> --- </option>
                        <option value="10" {{ old('limit_by', request('limit_by')) == '10' ? 'selected' : '' }}>10</option>
                        <option value="20" {{ old('limit_by', request('limit_by')) == '20' ? 'selected' : '' }}>20</option>
                        <option value="50" {{ old('limit_by', request('limit_by')) == '50' ? 'selected' : '' }}>50</option>
                        <option value="100" {{ old('limit_by', request('limit_by')) == '100' ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>
            <div class="col-2"></div>
            <div class="col-1">
                <div class="form-group">
                    <button type="submit" class="btn btn-link">
                        {{ __('Backend/contact_us.search') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
