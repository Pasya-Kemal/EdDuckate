let LoadedQuestions = {};
let CurrentAnswer = null;
let CurrentAnswerStatus = null;

function SaveAnswer(answer) {
    CurrentAnswer = answer;
    const statusAns = document.getElementById('status_answering');
    statusAns.innerText = 'Saving answer...';
    if(CurrentAnswerStatus !== null) {
        clearTimeout(CurrentAnswerStatus);
    }
    axios.post(_url('answerQuestion/' + QuestionID), {answer: answer}).then(function () {
        statusAns.innerText = 'Answer saved!';
    }).catch(function (e) {
        statusAns.innerHTML = '<span style="color: red">Error saving answer: ' + e + '</span>';
        console.log(e.response.data);
    }).finally(function () {
        CurrentAnswerStatus = setTimeout(function () {
            statusAns.innerText = '';
        }, 60000)
    });
}

document.addEventListener('DOMContentLoaded', function () {
    if(document.getElementById('ujianify_subject_container') === null) {
        return;
    }

    const answers = ['A', 'B', 'C', 'D', 'E'];

    answers.forEach(function (ans) {
        const answerButton = document.getElementById('btn_answer_' + ans);
        answerButton.addEventListener('click', function () {
            answers.forEach(function (otherAns) {
                const otherAnsElem = document.getElementById('btn_answer_' + otherAns);
                otherAnsElem.style.background = '#ffffff';
            });
            answerButton.style.background = '#97ffce';
            SaveAnswer(ans)
        });
    });
});

function MarkAnswered(ans) {
    const answerButton = document.getElementById('btn_answer_' + ans);
    answerButton.style.background = '#97ffce';
}

function ReqFullScreen() {
    document.documentElement.requestFullscreen();
}
