import HTTP from "../utils/HTTP";

export const obtainProjects = params => {
  const url = "/search/projects";

  return HTTP(url, params);
};

export const createProject = request => {
  const url = "/search/projects";
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

export const updateProject = request => {
  const url = "/search/projects";
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

export const refreshProject = params => {
  const url = "/search/projects/open";

  return HTTP(url, params);
};

export const deleteProject = request => {
  const url = "/search/projects";
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

export const exportToCSV = params => {
  const url = "/search/projects/export";

  return HTTP(url, params);
};
