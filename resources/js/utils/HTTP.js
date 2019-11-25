const buildUrl = (url, params) => {
  let queryString = "";

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const value = params[key];
      queryString +=
        encodeURIComponent(key) + "=" + encodeURIComponent(value) + "&";
    }
  }

  if (queryString.length > 0) {
    // get rid of last "&"
    queryString = queryString.substring(0, queryString.length - 1);
    url = url + "?" + queryString;
  }

  return url;
};

const parseJSON = (response) => {
  return new Promise((resolve) => response.json()
    .then((json) => resolve({
      status: response.status,
      ok: response.ok,
      json
    })));
};


const successWrapper = (response) => {
  return response.data;
};

const errorWrapper = (response) => {
  let messages = [];

  for (let prop in response.errors) {
    messages = [
      ...messages,
      ...response.errors[prop]
    ];
  }

  return messages;
};

const HTTP = (url, params = {}, options = {}) => {
  return new Promise((resolve, reject) => {
    fetch(buildUrl(url, params), {...options, credentials: "include"})
      .then(parseJSON)
      .then((response) => {
        if (response.ok) {
          return resolve(successWrapper(response.json));
        }
        return reject(errorWrapper(response.json));
      })
      .catch(() => reject({
        messages: [
          "Something went wrong..."
        ]
      }));
  });
};

export default HTTP;
