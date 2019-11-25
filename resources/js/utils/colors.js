const colors = [
  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de",

  "#6495ed",
  "#83aaf1",
  "#a2bff4",
  "#c1d5f8",
  "#e0eafb",
  "#6b8e23",
  "#89a54f",
  "#a6bb7b",
  "#c4d2a7",
  "#e1e8d3",
  "#ffa500",
  "#ffb733",
  "#ffc966",
  "#ffdb99",
  "#ffedcc",
  "#ff6347",
  "#ff826c",
  "#ffa191",
  "#ffc1b5",
  "#ffe0da",
  "#dc143c",
  "#e34363",
  "#ea728a",
  "#f1a1b1",
  "#f8d0d8",
  "#800080",
  "#993399",
  "#b366b3",
  "#cc99cc",
  "#e6cce6",
  "#40e0d0",
  "#66e6d9",
  "#8cece3",
  "#b3f3ec",
  "#d9f9f6",
  "#228b22",
  "#4ea24e",
  "#7ab97a",
  "#a7d1a7",
  "#d3e8d3",
  "#000080",
  "#333399",
  "#6666b3",
  "#9999cc",
  "#cccce6",
  "#808080",
  "#999999",
  "#b3b3b3",
  "#cccccc",
  "#e6e6e6",
  "#ffe600",
  "#ffeb33",
  "#fff066",
  "#fff599",
  "#fffacc",
  "#e5446d",
  "#ea698a",
  "#ef8fa7",
  "#f5b4c5",
  "#fadae2",
  "#89da59",
  "#a1e17a",
  "#b8e99b",
  "#d0f0bd",
  "#e7f8de"
];

export default colors;