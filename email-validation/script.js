// getting all required elements
const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const suggBox = searchWrapper.querySelector(".autocom-box");
let linkTag = searchWrapper.querySelector("a");
let webLink;

// if user press any key and release
let suggestions = [
            
];
inputBox.onkeyup = (e)=>{
    if(suggestions.length<1){
        suggestions = [
            
        ];
    }
    if(suggestions.length<1){
        if(e.target.value.length>2 && e.target.value.length<4){
            $.ajax({
                url: 'address.php',
                type: 'post',
                data: {'address':e.target.value},
                dataType: 'json',
                success: function(data) {
                    var result = [];
                    for(var i in data)
                        suggestions.push([data[i]]);


                    for(var i=0; i<suggestions.length<0; i++){
                        console.log(suggestions[i]+" || ");
                    }
                }
            }) 
        }
    }
    for(var i=0; i<suggestions.length<0; i++){
        console.log(suggestions[i]+" || ");
    }
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        
        emptyArray = suggestions.filter((data)=>{
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
            console.log(data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase()));
        });
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            return data = `<li>${data}</li>`;
        });
        searchWrapper.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");
        for (let i = 0; i < allList.length; i++) {
            //adding onclick attribute in all li tag
            allList[i].setAttribute("onclick", "select(this)");
        }
    }else{
        searchWrapper.classList.remove("active"); //hide autocomplete box
    }
}

function select(element){
    let selectData = element.textContent;
    inputBox.value = selectData;
    searchWrapper.classList.remove("active");
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;
    }else{
      listData = list.join('');
    }
    suggBox.innerHTML = listData;
}
