 // Access the bookedDates from the data attribute
 const bookedDates = JSON.parse(document.querySelector(".calendar").getAttribute('data-booked-dates'));

 const calendarContainer = document.querySelector(".calendar");
 const dateHeader = calendarContainer.querySelector(".date h1");
 const daysContainer = calendarContainer.querySelector(".days");

 const monthNames = [
     "January", "February", "March", "April", "May", "June",
     "July", "August", "September", "October", "November", "December"
 ];

 const today = new Date();
 let currentYear = today.getFullYear();
 let currentMonth = today.getMonth() + 1; // Note: JavaScript months are zero-indexed

 function renderCalendar(year, month) {
daysContainer.innerHTML = "";

const firstDay = new Date(year, month - 1, 1);
const lastDay = new Date(year, month, 0);

for (let i = 1; i <= lastDay.getDate(); i++) {
 const dayCell = document.createElement("div");
 dayCell.textContent = i;

 const currentDate = new Date(year, month - 1, i);
 const formattedDate = getFormattedDate(currentDate);

 const bookedDateInfo = bookedDates.find(dateInfo => dateInfo.date === formattedDate);

 if (bookedDateInfo) {
     console.log('Booking info for', formattedDate, ':', bookedDateInfo);

     dayCell.classList.add('booked');

     if (bookedDateInfo.max_booking) {
         console.log('Max booking on', formattedDate);
         dayCell.classList.add('max-booking');
     }

     if (bookedDateInfo.mid_booking) {
         console.log('Mid booking on', formattedDate);
         dayCell.classList.add('mid-booking');
     }
 }

 daysContainer.appendChild(dayCell);
}
}




 function updateCalendar() {
     dateHeader.textContent = `${monthNames[currentMonth - 1]} ${currentYear}`;
     renderCalendar(currentYear, currentMonth);
 }

 function updateMonth(step) {
     currentMonth += step;

     if (currentMonth < 1) {
         currentMonth = 12;
         currentYear--;
     } else if (currentMonth > 12) {
         currentMonth = 1;
         currentYear++;
     }

     updateCalendar();
 }

 calendarContainer.querySelector(".prev").addEventListener("click", () => {
     updateMonth(-1);
 });

 calendarContainer.querySelector(".next").addEventListener("click", () => {
     updateMonth(1);
 });

 updateCalendar();

 function getFormattedDate(date) {
const day = date.getDate().toString().padStart(2, '0');
const month = (date.getMonth() + 1).toString().padStart(2, '0');
const year = date.getFullYear();
return `${day}/${month}/${year}`;
}
