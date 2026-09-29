<x-layouts.app>
    <div class="forms">
        <h2>Contact</h2>
        <form action="../app/Http/Controllers/contactController.php" method="post">
            <div class="form-group text-input">
                <label for="">{{ __('misc.firstname')}}</label>
                <input type="text" name="firstname">
            </div>
            <div class="form-group text-input">
                <label for="">{{ __('misc.lastname')}}</label>
                <input type="text" name="lastname">
            </div>
            <div class="form-group text-input">
                <label for="">{{ __('misc.email')}}</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group form-radio">
                <div>
                    <input type="radio" name="reason" value="question">
                    <label for="">{{ __('misc.question')}}</label>
                </div>
                <div>
                    <input type="radio" name="reason" value="complaint">
                    <label for="">{{ __('misc.complaint')}}</label>
                </div>
                <div>
                    <input type="radio" name="reason" value="other">
                    <label for="">{{ __('misc.other')}}</label>
                </div>
                <div class="form-group form-reason">
                    <label for="">{{ __('misc.reason')}}</label>
                    <textarea name="message" id="message" rows="10" cols="40"></textarea>
                </div>
            </div>
                <div class="form-group">
                <input class="submit-button" type="submit" value={{ __('misc.sendbutton')}}>
            </div>
        </form>
    </div>
</x-layouts.app>
