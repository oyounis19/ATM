var sessionTimeoutMilliseconds = 63 * 1000;
var alertTimeoutMilliseconds = 3 * 1000; // 3 seconds
var timeoutTimer;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

function logout() {
  Toast.fire({
    icon: 'success',
    title: 'Session Timeout, Directing to Home screen'
  });

  setTimeout(() => {
    window.location.href = 'index';
  }, 3000);
}

function resetTimeout() {
  clearTimeout(timeoutTimer);
  timeoutTimer = setTimeout(logout, sessionTimeoutMilliseconds - alertTimeoutMilliseconds);
}

window.addEventListener('mousemove', resetTimeout);
window.addEventListener('keypress', resetTimeout);
window.addEventListener('click', resetTimeout);

resetTimeout();
