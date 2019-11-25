import HTTP from "../utils/HTTP";

export const obtainInitialData = () => {
  const url = "/search/initial";

  return HTTP(url);
};

export const search = request => {
  const url = "/search/searching";
  const options = {
    method: "POST",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};

export const obtainSavedSearches = params => {
  const url = "/search/criterias";

  return HTTP(url, params);
};

export const createSearch = request => {
  const url = "/search/criterias";
  const options = {
    method: "POST",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};

export const updateSearch = request => {
  const url = "/search/criterias";
  const options = {
    method: "PATCH",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};

export const deleteSearch = request => {
  const url = "/search/criterias";
  const options = {
    method: "DELETE",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};

export const exportToCSV = request => {
  const url = "/search/export";
  const options = {
    method: "POST",
    headers: {
      "Accept": "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(request)
  };

  return HTTP(url, {}, options);
};

export const LogLinkclickAction = params => {
  const url = "/search/linkaction";

  return HTTP(url, params);
};
