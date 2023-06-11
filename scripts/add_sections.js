let sectionCount = 1;

document.addEventListener('DOMContentLoaded', function() {
    var addButton = document.getElementById('add-section__button');
    var sectionContainer = document.querySelector('.section-input');

    addButton.addEventListener('click', function() {
      var newSection = createSection();
      sectionContainer.appendChild(newSection);
    });


    var section1 = document.getElementById('section1');
    var deleteButton = section1.querySelector(".section-input__delete-button");
    deleteButton.addEventListener('click', function () { 
        deleteSection(1);
    })

    function createSection() {
      var section = document.createElement('div');
      section.className = 'section-input__section';
      sectionCount+=1;
      // Генерируем уникальный id для секции
      var sectionId = 'section' + sectionCount;
      section.setAttribute('id', sectionId);
    
      // Добавляем содержимое секции
      section.innerHTML = `
        <div class="section-input__main">
            <div class="section-input__section-inner">
                <div class="section-input__number">
                    ${sectionCount}
                </div>
                <div class="section-input__text">
                    <textarea required name = "section-input_text[]" class="section-input__textarea"></textarea>
                </div>
                <div class="section-input__delete">
                    <button type = "button" class="section-input__delete-button"></button>
                </div>
            </div>
        </div>
        <div class="section-input__file">
            <label for="section-input_file-input" class="file-input-label">Зображення розділу</label>
            <input required name = "section-input_file[]" id = "section-input_file-input${sectionCount}" type="file" class="section-input_file-input" accept=".jpg, .png, .jpeg">
        </div>
      `;
   
      var deleteButton = section.querySelector(".section-input__delete-button");
      deleteButton.addEventListener('click', deleteSection.bind(null, sectionCount));
      return section;
    }


    function deleteSection(index) {
        let sections = document.getElementsByClassName("section-input__section");
        let change = false;
        for(let section of sections) {
            let sectionId = section.id;
            if(sectionId == "section" + index) {
                section.remove();
                change = true;
            }
        }
        sections = document.getElementsByClassName("section-input__section");
        for(let i = 0; i < sections.length; i++) {
            var sectionNumber = sections[i].querySelector(".section-input__number");
            sectionNumber.innerHTML = i+1;
        }
        sectionCount--;
      }

  });

