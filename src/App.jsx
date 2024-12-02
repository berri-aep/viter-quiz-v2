import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Quiz from "./components/pages/frontend/Quiz";
import { StoreProvider } from "./components/store/storeContext";
import Question from "./components/pages/backend/questions/Question";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import Welcome from "./components/pages/frontend/Welcome";

const App = () => {
  const queryClient = new QueryClient();

  return (
    <QueryClientProvider client={queryClient}>
      <StoreProvider>
        <Router>
          <Routes>
            <Route index element={<Welcome />} />
            <Route path="/quiz" element={<Quiz/>} />
            <Route path="/admin/question" element={<Question />} />
          </Routes>
        </Router>
      </StoreProvider>
    </QueryClientProvider>
  );
};

export default App;
