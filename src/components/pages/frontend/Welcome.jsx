import { setName } from "@/components/store/storeAction";
import { StoreContext } from "@/components/store/storeContext";
import React from "react";
import { useNavigate } from "react-router-dom";

const Welcome = () => {
    const navigate = useNavigate();
    const {store, dispatch} = React.useContext(StoreContext);
    const nameRef = React.useRef(null);
    const handleEnterName = () => {
        dispatch(setName(nameRef.current.value));
        navigate("/quiz");
    }
  return (
    <div className="flex justify-center items-center h-screen w-full">
      <div className="w-[400px] min-h-[100px] bg-blue-300 rounded-md p-4">
        <form action="">
          <label htmlFor="" className="block mb-3 text-dark font-semibold">
            Name
          </label>
          <input
            type="text"
            placeholder="Enter Your Name"
            className="w-full p-3 text-lg rounded-md"
            ref={nameRef}
          />
          <button
            className="block mt-3 p-2 rounded-md bg-blue-800 text-white w-full "
            onClick={handleEnterName}
            type="button"
          >
            Enter
          </button>
        </form>
      </div>
    </div>
  );
};

export default Welcome;
