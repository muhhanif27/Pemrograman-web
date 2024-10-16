const taskInput = document.querySelector("#taskInput");
const taskList = document.querySelector("#taskList");


function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText === "") {
        alert("Task cannot be empty!"); 
        return;
    }

    const li = document.createElement("li");

    const taskSpan = document.createElement("span");
    taskSpan.textContent = taskText;
    taskSpan.className = "task-text";

    const editButton = document.createElement("button");
    editButton.innerHTML = '<i class="fas fa-edit"></i>'; 
    editButton.className = "edit-button";
    editButton.onclick = () => editTask(li, taskSpan);

    
    const deleteButton = document.createElement("button");
    deleteButton.innerHTML = '<i class="fas fa-trash"></i>'; 
    deleteButton.className = "delete-button";
    deleteButton.onclick = () => deleteTask(li);

    li.appendChild(taskSpan);
    li.appendChild(editButton);
    li.appendChild(deleteButton);

  
    taskList.appendChild(li);

   
    taskInput.value = "";
}


function editTask(listItem, taskSpan) {
    
    const tempInput = document.createElement("input");
    tempInput.type = "text";
    tempInput.value = taskSpan.textContent;
    tempInput.className = "edit-input";

    listItem.replaceChild(tempInput, taskSpan);

  
    tempInput.focus();

    
    tempInput.addEventListener("blur", () => {
        taskSpan.textContent = tempInput.value.trim() || taskSpan.textContent;
        listItem.replaceChild(taskSpan, tempInput);
    });

    
    tempInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            taskSpan.textContent = tempInput.value.trim() || taskSpan.textContent;
            listItem.replaceChild(taskSpan, tempInput);
        }
    });
}

function deleteTask(listItem) {
    taskList.removeChild(listItem);
}
