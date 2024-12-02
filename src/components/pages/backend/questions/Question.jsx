import { Plus } from "lucide-react";
import React from "react";
import SideNavigation from "../partials/SideNavigation";
import Header from "../partials/Header";
import Footer from "../partials/Footer";
import Searchbar from "../partials/Searchbar";
import QuestionTable from "./QuestionTable";
import { StoreContext } from "@/components/store/storeContext";
import { setIsAdd } from "@/components/store/storeAction";
import ModalError from "../partials/modals/ModalError";
import ModalValidation from "../partials/modals/ModalValidation";
import ModalAddQuestion from "./ModalAddQuestion";
import ToastSuccess from "../partials/ToastSuccess";

const Question = () => {
  const { dispatch, store } = React.useContext(StoreContext);
  const [itemEdit, setItemEdit] = React.useState(null);

  const handleAdd = () => {
    dispatch(setIsAdd(true));
    setItemEdit(null);
  };
  return (
    <>
      <section className="layout-main ">
        <div className="layout-division ">
          <SideNavigation menu="question" />
          <main>
            <Header title="Question" subtitle="Manage Question" />
            <div className="p-8">
              <div className="flex justify-between items-center">
                <Searchbar />
                <button className="btn btn-add" onClick={handleAdd}>
                  <Plus size={16} /> Add New
                </button>
              </div>
              <QuestionTable setItemEdit={setItemEdit} />
            </div>
            <Footer />
          </main>
        </div>
      </section>
      {store.validate && <ModalValidation />}
      {store.error && <ModalError />}
      {store.success && <ToastSuccess />}
      {store.isAdd && <ModalAddQuestion itemEdit={itemEdit}/>}
    </>
  );
};

export default Question;
