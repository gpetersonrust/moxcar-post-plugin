(()=>{"use strict";document.querySelectorAll(".subscribers-card").forEach((function(e){let t=e.querySelector(".subscriber-options"),r=e.getAttribute("id"),n=e.querySelector(".subscriber-option-forms");(function(e,t){let r=e.querySelector("#delete_user"),n="update",s=e.querySelector("button");r.addEventListener("change",(function(){r.checked?(n="delete",s.textContent="Delete User",s.classList.add("delete-user-button")):(n="update",s.textContent="Update User",s.classList.remove("delete-user-button")),console.log(n)})),e.addEventListener("submit",(async function(r){try{if(r.preventDefault(),"delete"===n&&!confirm("Are you sure you want to delete this user?"))return;let s=document.createElement("input");s.setAttribute("type","hidden"),s.setAttribute("name","action"),s.setAttribute("value",n),e.appendChild(s);let u=document.createElement("input");u.setAttribute("type","hidden"),u.setAttribute("name","user_id"),u.setAttribute("value",t),e.appendChild(u),e.submit()}catch(e){return console.log(e),alert("An error occured please try again later")}}))})(n.querySelector("form"),r),t.addEventListener("click",(function(){console.log(n),"none"!==n.style.display&&n.style.display?n.style.display="none":n.style.display="flex"}))}))})();
//# sourceMappingURL=admin-wp343ecd7c5342e51202a3.js.map