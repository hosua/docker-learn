import "./App.css";
import CoolTable from "./pages/CoolTable";
import { Button } from "@/components/ui/button";
import { useState } from "react";

function App() {
  const [result, setResult] = useState<null | string>(null);
  const fetchFromApi = async () => {
    setResult(null);
    try {
      const response = await fetch("/api/test");
      const result = await response.json();
      console.log(result);
      setResult(result.message);
    } catch (e) {
      console.error(e);
    }
  };

  return (
    <>
      <CoolTable />
      <Button variant="outline" onClick={fetchFromApi}>
        API Test
      </Button>
      <br />
      {result}
    </>
  );
}

export default App;
