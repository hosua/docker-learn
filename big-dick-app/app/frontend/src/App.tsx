import "./App.css";

import CoolTable from "./pages/CoolTable";

import { Button } from "@/components/ui/button";

function App() {
  const fetchFromApi = async () => {
    try {
      const response = await fetch("/api/test");
      const result = await response.json();
      console.log(result);
    } catch (e) {
      console.error(e);
    }
  };

  return (
    <>
      <CoolTable />
      <Button variant="outline" onClick={fetchFromApi}>
        button
      </Button>
    </>
  );
}

export default App;
