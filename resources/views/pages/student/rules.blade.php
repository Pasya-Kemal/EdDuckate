@extends('pages.student.base')

@section('container')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Subject: {{ $subject->name }}</h1>
        <p class="text-lg text-gray-600 mb-8">Time :
            {{ number_format($subject->starts_at->diffInMinutes($subject->ends_at), 0, ',', '.') }} Minutes</p>
        <script>
            function doTypewriting(element, txt, onDone) {
                let i = 0;
                const typewriter = function() {
                    if (i < txt.length) {
                        element.innerHTML += txt.charAt(i);
                        i++;
                        setTimeout(typewriter, (Math.random() < 0.5 ? 5 : Math.floor(Math.random() * (100 - 80 + 1)) + 80));
                    }else{
                        onDone();
                    }
                }
                typewriter();
            }
            const rules = [
                "Use a computer or laptop that is connected to the internet.",
                "It is not allowed to open applications or websites other than those related to the exam.",
                "It is not allowed to open documents or files on a computer or laptop.",
                "Not allowed to communicate with other people during the exam.",
                "Do not leave your seat during the exam unless there is an emergency.",
                "Make sure the internet connection and devices are working properly before the exam starts.",
                "The exam supervisor will monitor your activity during the exam.",
                "When finished, don't forget to press the Submit button.",
                "At the time of the exam students are required to enlarge the application screen by pressing, F11.",
                "Students are prohibited from opening other tabs or applications during the exam.",
                "Finally, good luck and keep fighting.",
            ]
            function doWriteRule(index) {
                if(index === rules.length) {
                    return;
                }
                const elem = document.getElementById("rulesList");
                const newElem = document.createElement("li");
                newElem.classList.add("mb-2");
                elem.appendChild(newElem);
                doTypewriting(newElem, rules[index], function() {
                    if(rules.length > index) {
                        doWriteRule(index + 1);
                    }
                });
            }
            document.addEventListener('DOMContentLoaded', function() {
                doWriteRule(0);
            });
        </script>
        <div class="bg-white rounded-lg overflow-hidden shadow-md">
            <div class="flex px-4 py-4 gap-2">
                <div>
                    <img style="width: 350px" src="{{ url('/images/rules.gif') }}" alt="rules anim"/>
                </div>
                <div class="w-full">
                    <h2 class="text-lg font-bold mb-4">Online Exam Rules</h2>
                    <ul class="list-disc list-inside" id="rulesList"></ul>
                </div>
            </div>
            <div class="px-4 py-2 bg-gray-100">
                <form action="{{ url('/subject/' . $subject->id) }}">
                    <button class="inline-block px-4 py-2 rounded-md text-white bg-indigo-500 hover:bg-indigo-600" onclick="ReqFullScreen();">Start Exam</button>
                </form>
            </div>
        </div>
    </div>
@endsection
