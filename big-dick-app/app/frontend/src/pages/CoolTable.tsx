import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table";

import { Button } from "@/components/ui/button";

import { useState } from "react";

const CoolTable = () => {
  const [tableData, setTableData] = useState<unknown[] | null>(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchMockData = async () => {
    setLoading(true);
    setError(null);
    try {
      const url = `/mock-api/users`;
      const res = await fetch(url);
      if (!res.ok) {
        throw new Error(`Failed to fetch: ${res.statusText}`);
      }
      const contentType = res.headers.get("content-type");
      if (!contentType || !contentType.includes("application/json")) {
        const text = await res.text();
        throw new Error(
          `Expected JSON but got ${contentType}. Response: ${text.substring(0, 100)}`,
        );
      }
      const result = await res.json();
      if (!Array.isArray(result)) {
        throw new Error("Response is not an array");
      }
      setTableData(result);
    } catch (err) {
      setError(err instanceof Error ? err.message : "Failed to fetch data");
    } finally {
      setLoading(false);
    }
  };

  const getSchema = () => {
    if (!tableData || !Array.isArray(tableData) || tableData.length === 0) {
      return null;
    }
    const firstItem = tableData[0];
    if (typeof firstItem !== "object" || firstItem === null) {
      return null;
    }
    return Object.keys(firstItem);
  };

  const formatValue = (value: unknown): string => {
    if (value === null || value === undefined) {
      return "";
    }
    if (typeof value === "object") {
      return JSON.stringify(value);
    }
    return String(value);
  };

  const formatHeader = (key: string): string => {
    return key
      .split("_")
      .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
      .join(" ");
  };

  const schema = getSchema();

  return (
    <div className="space-y-4">
      <Button onClick={fetchMockData} disabled={loading}>
        {loading ? "Loading..." : "Fetch Data"}
      </Button>

      {error && <div className="text-red-500">Error: {error}</div>}

      {schema && tableData && Array.isArray(tableData) && (
        <Table>
          <TableHeader>
            <TableRow>
              {schema.map((key) => (
                <TableHead key={key}>{formatHeader(key)}</TableHead>
              ))}
            </TableRow>
          </TableHeader>
          <TableBody>
            {tableData.map((row, index) => (
              <TableRow key={index}>
                {schema.map((key) => (
                  <TableCell key={key}>
                    {formatValue(
                      typeof row === "object" && row !== null
                        ? (row as Record<string, unknown>)[key]
                        : null,
                    )}
                  </TableCell>
                ))}
              </TableRow>
            ))}
          </TableBody>
        </Table>
      )}

      {tableData && !schema && (
        <div className="text-gray-500">No valid table data structure found</div>
      )}
    </div>
  );
};

export default CoolTable;
