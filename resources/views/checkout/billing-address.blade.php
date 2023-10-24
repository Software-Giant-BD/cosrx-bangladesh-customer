<div class="col-lg-6">
    <div class="checkout-billing-details-wrap">
        <h2 class="title">Billing details</h2>
        <div class="billing-form-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="f_name">Name <abbr class="required" title="required">*</abbr></label>
                        <input id="f_name" type="text" class="form-control" name="name" required
                            value="{{ old('name', $user['name']) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="phone">Mobile <abbr class="required" title="required">*</abbr></label>
                        <input type="number" class="form-control" id="mobile" name="mobile" required
                            value="{{ old('mobile', $user['mobile']) }}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Full address <abbr class="required" title="required">*</abbr></label>
                        <input type="text" class="form-control" placeholder="Your full address" name="full_address"
                            required value="{{ old('full_address') }}"
                            value="{{ old('full_address', $user['address']) }}">
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email Address (optional) </label>
                        <input id="email" name="email" type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-0">
                        <label for="order-notes">Order notes (optional)</label>
                        <textarea id="order-notes" name="customer_note" class="form-control"
                            placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
