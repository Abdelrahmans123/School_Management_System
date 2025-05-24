<div>
    @csrf
    @php
        $answers = preg_split('/(-)/', $questions[$counter]->answers);

    @endphp
    <h5>{{ $questions[$counter]->title }}</h5>
    @foreach ($answers as $item)
        <div class="form-check">
            <input class="form-check-input" type="radio" name="radioDefault" id="radioDefault{{ $loop->iteration }}"
                wire:click="nextQuestion({{ $questions[$counter]->id }}, {{ $questions[$counter]->score }}, '{{ $item }}', '{{ $questions[$counter]->right_answer }}')">

            <label class="form-check-label" for="radioDefault{{ $loop->iteration }}">
                {{ $item }}
            </label>
        </div>
    @endforeach
    <script>
        window.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', () => {
                resetRadioButtons();
            });
        });

        // Reset radio buttons
        function resetRadioButtons() {
            var radioButtons = document.querySelectorAll('input[name="radioDefault"]');
            radioButtons.forEach(function(radioButton) {
                radioButton.checked = false;
            });
        }
       
    </script>
</div>
