function changeCar(number) {
  const carImage = document.querySelector('.car-image');
  const title = document.querySelector('.title');

  switch(number) {
    case 1:
      carImage.src = 'https://media.gettyimages.com/id/648916536/photo/car-being-towed.jpg?s=612x612&w=0&k=20&c=eXvFw_tdbQN2S3VdwbXuyMKDz6B55_giR0WxOIQQgQU=';
      title.innerText = '🚘 Emergency Roadside Assistance';
      break;
    case 2:
      carImage.src = 'https://plus.unsplash.com/premium_photo-1677009835876-4a29ddc4cc2c?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8bWVjaGFuaWN8ZW58MHx8MHx8fDA%3D';
       
      title.innerText = '🚿 Other Specialized Services';
      break;
    case 3:
      carImage.src = 'https://media.istockphoto.com/id/522394158/photo/car-service-procedure.jpg?s=612x612&w=0&k=20&c=SXPyg7yMw0Uc4LuI59lchMouvjJ3z6r5oNKO7mdnHCc=';
       
      // carImage.src = 'https://plus.unsplash.com/premium_photo-1676998430860-22766e72010d?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTd8fG1lY2hhbmljfGVufDB8fDB8fHww';
       
      title.innerText = '⚡ Electrical Repairs';
      break;
    case 4:
      carImage.src = 'https://media.istockphoto.com/id/1292990161/photo/wheel-alloy-wheels-rim-or-mag-wheel-high-performance-auto-part-decoration.jpg?s=612x612&w=0&k=20&c=TrmjutCf3hPY_f6hPONTR1Gmv-Bm-nHh8-ghyb0vbuY=';
       
      title.innerText = '🛞 Tires & Wheels';
      break;
  }
}

function scrollToSection(id) {
  document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
}
// images container


  // Show the modal with the information
 
  function showInfo(title, details, modalId) {
    const modal = document.getElementById(modalId);
    modal.querySelector('#carTitle').innerText = title;
    modal.querySelector('#carDetails').innerText = details;
    modal.style.display = 'flex';
  }
  
  function closeInfo(modalId) {
    document.getElementById(modalId).style.display = 'none';
  }
  
  

// header js

  let tooltip;

  const registerBtn = document.getElementById('registerBtn');

  registerBtn.addEventListener('mouseenter', () => {
    tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.innerHTML = 'Already registered? <a href="login.php">Login here</a>.';

    // Positioning based on button
    const rect = registerBtn.getBoundingClientRect();
    tooltip.style.top = rect.bottom + window.scrollY + "px";
    tooltip.style.left = rect.left + (rect.width / 2) + "px";

    document.body.appendChild(tooltip);
    tooltip.style.display = 'block';

    tooltip.addEventListener('mouseenter', () => {
      tooltip.style.display = 'block';
    });

    tooltip.addEventListener('mouseleave', () => {
      tooltip.remove();
    });
  });

  registerBtn.addEventListener('mouseleave', () => {
    setTimeout(() => {
      if (!tooltip.matches(':hover')) {
        tooltip.remove();
      }
    }, 300);
  });

