export const formatNumber = (number) =>
  number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

export const getCookie = (name) => {
  let match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
  if (match) {
    return JSON.parse(match[2]);
  }
  return [];
};

export const updateCookie = (cookie) => (document.cookie = cookie);
