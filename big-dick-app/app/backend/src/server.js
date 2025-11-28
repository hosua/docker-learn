const path = require("path");
const express = require("express");

const app = express();
const port = process.env.PORT || 3000;

app.get("/api/test", (req, res) => {
  const message = "You hit da API bitch ass";
  console.log(message);
  res.send({ message });
});

console.log(`Running server on port ${port}...`);
app.listen(port);
