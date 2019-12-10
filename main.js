$(document).ready(() => {

  let quiz;

  $.get("http://websites.lezasolutions.com/example.json", function (data) {

    quiz = data.quiz;

    $("#questions").html(`
      ${quiz.map((question, index) => {return getQuestion(question, index)}).join("")}
      <div class="form-group row mt-5 text-center mb-5">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-lg btn-success">Submit</button>
        </div>
      </div>
    `);
  });
  

  //Validate Submission
  $('#questions').on('submit', function() {

    let pass = true;

    for (let index = 0; index < quiz.length; index++) {

      $(`#message${index}`).html('');

      var value = $(`input[name='${index}']:checked`).val();
      console.log(value);
      if(value === undefined) {
        pass = false;
        $(`#message${index}`).html('Please answer this question !!');
      }
    }

    return pass;

  });
})

function getQuestion(question, index) {
  return `
    <fieldset class="form-group">
      <div class="card border-0 shadow mb-4" style="">
        <div class="card-body"> 
          <h5 class="card-title"><legend class="form-label">${question.question}</legend></h5>
          <div class="form-check-inline">
            ${question.options.map((option, i) => {return getOptions(option, i, index)}).join("")}
          </div>
          <p class="mt-3 text-danger" id="message${index}"></p>
        </div>
      </div>
    </fieldset>
  `;
}

function getOptions(option, i, questionNo) {
  return `
    <div class="form-check pl-0 mr-4">
      <input class="form-check-input" type="radio" name="${questionNo}" id="option${questionNo}${i}" value="${option}">
      <label class="form-check-label" for="option${questionNo}${i}">
          ${option}
      </label>
    </div>
  `;
}