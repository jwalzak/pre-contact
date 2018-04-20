const button = document.querySelector('.submit')
const modal = document.querySelector('.modal')
const closeButton = document.querySelector('.close-button')
let jsonData, formData, trigger, currentEdit

// loads data on page load
window.onload = function() {
  fetch('./handle_event.php?action=load')
    .then(res => res.json())
    .then(res => displayContacts(res))
    .catch(e => console.error('Something went wrong ', e))
}

button.addEventListener('click', e => {
  e.preventDefault()
  const newForm = document.querySelector('#newForm')
  getFormValues(newForm)
  sendJsonData(formData)
  resetForm()
})

function displayContacts(contactData) {
  for (contact of contactData) {
    const aside = document.querySelector('.list')
    const asideEl = document.createElement('div')
    const bdayCake = '🎂'
    const contrastText = getContrastYIQ(contact.background_col)
    const today = getDate()
    asideEl.className = 'contact'
    aside.appendChild(asideEl)
    asideEl.innerHTML = `
    <div style="background: ${contact.background_col}">
    <h3  style="color: ${contrastText}">${contact.fname} ${contact.lname}</h3>
    <p><a href="mailto:${contact.email}" style="color: ${contrastText}">${
      contact.email
    }</a></p>
    <p><a href="tel:${contact.phone}" style="color: ${contrastText}">${
      contact.phone
    }</a></p>
    <p style="color: ${contrastText}">
    ${
      // Will display an emoji cake if it is the contact's birthday
      today === contact.birthday
        ? contact.birthday + ' ' + bdayCake
        : contact.birthday
    }
    </p>
    <p><a href="${contact.homepage}" style="color: ${contrastText}">${
      contact.homepage
    }</a></p>
    <p style="color: ${contrastText}">${contact.relationship}</p>
    <button class="del-button-${contact.id}" 
    onClick="deleteContact(${contact.id})">Delete</buton>
    <button class="upd-button trigger" 
    onClick="toggleModal(); getId(${contact.id});">Edit</buton>
    </div>
    `
  }
  trigger = document.querySelector('.trigger')
  trigger.addEventListener('click', toggleModal)
} // End displayContacts()

function getId(id) {
  return currentEdit = id
}// End getId()

function toggleModal() {
  fillForm()
  modal.classList.toggle('show-modal')
  clearResetList()
} // end toggleModal()

function windowOnClick(event) {
  if (event.target === modal) {
    toggleModal()
  }// End if
} // End windowOnClick()

closeButton.addEventListener('click', toggleModal)
window.addEventListener('click', windowOnClick)

function getFormValues(formId) {
  formData = new FormData(formId)
  const fname = formData.get('fname')
  const lname = formData.get('lname')
  const email = formData.get('email')
  const phone = formData.get('phone')
  const birthday = formData.get('birthday')
  let relationship = formData.get('relationship') // It may be changed
  const step = formData.get('step')
  const homepage = formData.get('homepage')
  const background = formData.get('background')
  if (step == 'on') {
    relationship = `Step-${relationship}`
  } // End if

  jsonData = {
    fname,
    lname,
    email,
    phone,
    birthday,
    relationship,
    step,
    homepage,
    background,
  }

  console.log(jsonData)
  formData.append('json', jsonData)
  return jsonData
} // End getFormValues()

function sendJsonData(jsonObj) {
  fetch('./handle_event.php?action=new', { method: 'POST', body: jsonObj })
    .then(res => res.json())
    .then(res => console.log(res))
    .catch(e => console.error('Something went wrong ', e))
} // End sendJsonData()

function deleteContact(id) {
  fetch(`./handle_event.php?action=delete&id=${id}`)
    .then(res => res.json())
    .then(res => console.log(res))
    .catch(e => console.error('Something went wrong ', e))
    clearResetList()
} // End deleteContact()

function updateContact() {
  const updateForm = document.querySelector('#updateForm')
  let jsonObjUp = getFormValues(updateForm)
  // const id = document.querySelector('.hidden-id').value
  fetch(`./handle_event.php?action=update&id=${currentEdit}`, {
    method: 'POST',
    headers: { 'Content-type': 'Application/json' },
    body: JSON.stringify(jsonObjUp),
  })
    .then(res => res.json())
    .then(res => console.log(res))
    .catch(e => console.error('Something went wrong ', e))
}// End updateContact()

// The edit button and the save button in the modal
const editButton = document.querySelector('.upd-button')
editButton.addEventListener('click', e => e.preventDefault())
const saveButton = document.querySelector('.update')
saveButton.addEventListener('click', e => e.preventDefault())

function fillForm() {}// End fillForm()

function getDate() {
  const date = new Date()
  const year = date.getFullYear()
  let month = date.getMonth() + 1 // Months are zero indexed
  let day = date.getDate()

  // Add a 0 to the front to match the format of the result data
  if (month < 10) {
    month = `0${month}`
  }

  if (day < 10) {
    day = `0${day}`
  }

  return `${year}-${month}-${day}`
}// End getDate()

// Determine if the colour should be light or dark based on the RGB value
function getContrastYIQ(hexcolor) {
  const r = parseInt(hexcolor.substr(1, 2), 16)
  const g = parseInt(hexcolor.substr(3, 2), 16)
  const b = parseInt(hexcolor.substr(5, 2), 16)
  const yiq = (r * 299 + g * 587 + b * 114) / 1000
  return yiq >= 128 ? 'black' : 'white'
}// End  getContrastYIQ()

function resetForm() {
  // Clears out the form
  const reset = document.querySelector('#newForm')
  reset.reset()
  clearResetList()
}// End resetForm()

function clearResetList() {
  const contactList = document.querySelector('.list')
  contactList.innerHTML = ''
  fetch('./handle_event.php?action=load')
    .then(res => res.json())
    .then(res => displayContacts(res))
    .catch(e => console.error('Something went wrong ', e))
}// End clearResetList()
